<?php
/**
 * 工具类
 */
namespace RongCloud\Lib;

class Utils
{
    /**
     * 数字长度是否匹配
     * @param $params
     * @return bool
     */
    public function isLength($params)
    {
        $val = $params['val'];
        $min = isset($params['min'])?$params['min']:0;
        $len = !is_array($val)?strlen($val):count($val);
        $max = isset($params['max'])?$params['max']:0;
        $isLen = false;
        if ($len < $min || $len > $max) {
            $isLen = true;
        }
        return $isLen;
    }

    /**
     * 重命名
     * @param $obj
     * @param array $array
     * @return mixed
     */
    public function rename($obj,$array=[]){
        foreach ($array as $key=>$v){
            if(isset($obj[$key])){
                $obj[$v] = isset($obj[$key])?$obj[$key]:"";
                unset($obj[$key]);
            }
        }
        return $obj;
    }

    /**
     * 模板替换
     * @param $temp
     * @param $data
     * @return mixed
     */
    public function tplEngine ($temp,$data)
    {
        foreach ($data as $k=>$v)
        {
            $v = is_array($v)|| is_object($v)?"object":$v;
            $temp = str_replace("{{{$k}}}",$v, $temp);
        }
        return $temp;
    }

    /**
     * 获取错误信息
     * @param $params
     * @return array|mixed
     */
    public function getError($params)
    {
        $code = $params['code'];
        $errorInfo = [];
        if (is_array($code))
        {
            $errorInfo = $this->rename($code, ['errorMessage'=> 'msg']);
            $code = $errorInfo['code'];
        }
        $errors = $params['errors'];
        $info = isset($params['info'])?$params['info']:[];
    
        $error = isset($errors[$code])?$errors[$code]:[];
        if (!$error) {
            $error = $errorInfo;
        }
        if(isset($error['msg'])){
            $error['msg'] = $code ? $this->tplEngine($error['msg'], $info):$errorInfo['msg'];
        }
        return $error;
    }

    /**
     * 参数长度验证
     * @param $params
     * @return array|mixed|null
     */
    public function checkLength ($params)
    {
        $proto = $params['proto'];
        $verify = ($params['verify'][$proto]['length']);
        $val = $params['val'];
        $errors = $params['response'];
    
        $isLen = $this->isLength([
            'max'=> $verify['max'],
            'min'=>$verify['min'],
            'val'=> $val
        ]);
    
        $error = null;
        if ($isLen) {
            $error = $this->getError([
                'code'=> $verify['invalid'],
                'errors'=> $errors,
                'info'=> [
                    'name'=> $proto,
                    'max'=> $verify['max'],
                    'min'=> $verify['min'],
                    'len'=> substr($val,0,$verify['max'])
                ]
            ]);
        }
        return $error;
    }

    /**
     * 参数类型验证
     * @param $params
     * @return array|int|mixed
     */
    public function checkTypeof($params)
    {
        $error = 0;
        $proto = $params['proto'];
        $verify = ($params['verify'][$proto]['typeof']);
        $val = $params['val'];
        $errors = $params['response'];
        $isFalse = 0;
        if($verify['type'] == "array" && !is_array($val)){
            $isFalse = 1;
        }
        if($verify['type'] == "number" && !is_numeric($val)){
            $isFalse = 1;
        }
        if($isFalse){
            $error = $this->getError([
                'code'=> $verify['invalid'],
                'errors'=> $errors,
                'info'=> [
                    'currentType'=> gettype($val),
                    'name'=> $proto,
                    'type'=> $verify['type']
                ]
            ]);
        }
        return $error;
    }

    /**
     * 参数验证
     * @param $params
     * @return null
     */
    public  function check($params)
    {
        $error = null;
        $model = $params['model'];
        $api = $params['api'];
        $errors = $api['response']['fail'];
        $dataModel = $api['params'][$model];
        $data = isset($params['data'])?$params['data']:[];
        $verify = $params['verify'];
        $checkMap = [
                'length'=>'checkLength',
                'require'=>'checkRequire',
                'typeof'=>'checkTypeof',
                'size'=>'checkSize'
        ];
        $isBreak = false;
        foreach($dataModel as $proto=>$val ){
            if ($isBreak) {
                break;
            }
            $protoVerify = isset($verify[$proto])?$verify[$proto]:"";
            if ($protoVerify) {
                foreach( $protoVerify as $rule=>$ruleVal){
                    $fun = $checkMap[$rule];
                    $error = $this->$fun([
                        'verify'=>$verify,
                        'proto'=> $proto,
                        'val'=> isset($data[$proto])?$data[$proto]:"",
                        'response'=>$errors
                    ]);
                    if ($error) {
//                        var_dump($errors,$fun,$verify,$data,$proto);
                        $isBreak = true;
                        break;
                    }
                }
            }
        }
        return $error;
    }

    /**
     * 参数大小验证
     * @param $params
     * @return array|mixed|null
     */
    function checkSize ($params)
    {
        $error = null;
        $proto = $params['proto'];
        $verify = $params['verify'][$proto]['size'];
        $size = $params['val'];
        if(is_array($params['val'])){
            $size = count($params['val']);
        }
        if(is_string($params['val'])){
            $size =strlen($params['val']);
        }
        $errors = $params['response'];
        $isIllegal = ($size < $verify['min'] || $size > $verify['max']);
        if ($isIllegal) {
            $error = $this->getError([
                'code'=> $verify['invalid'],
                'errors'=> $errors,
                'info'=> [
                    'size'=> $size
                ]
            ]);
        }
    
        return $error;
    }

    /**
     * 参数 必填验证
     * @param $params
     * @return array|mixed|null
     */
    function checkRequire ($params)
    {
        $error = null;
        $proto = $params['proto'];
        $verify = $params['verify'][$proto]['require'];
        $errors = $params['response'];
        $isIllegal = empty($params['val'])?1:0;
        if($isIllegal){
            $error = $this->getError([
                            'code'=>$verify['invalid'],
                            'errors'=>$errors,
                            'info'=>[
                                'name'=>$proto
                            ]
                        ]);
        }

        return $error;
    }

    /**
     * json 数据获取
     * @param string $path
     * @return mixed
     */
    public static function getJson($path="")
    {
        $files = file_get_contents(RONGCLOUOD_ROOT.$path);
        return json_decode($files, true);
    }
    /**
     * 变量友好化打印输出
     * @param variable  $param  可变参数
     * @example dump($a,$b,$c,$e,[.1]) 支持多变量，使用英文逗号符号分隔，默认方式 print_r，查看数据类型传入 .1
     * @version php>=5.6
     * @return void
     */
    public static function dump(){
		$param = func_get_args();
        echo '<style>.php-print{background:#eee;padding:10px;border-radius:4px;border:1px solid #ccc;line-height:1.5;white-space:pre-wrap;font-family:Menlo,Monaco,Consolas,"Courier New",monospace;font-size:13px;}</style>', '<pre class="php-print">';

        if(end($param) === .1){
            array_splice($param, -1, 1);

            foreach($param as $k => $v){
                echo $k>0 ? '<hr>' : '';

                ob_start();
                Utils::dump($v);

                echo preg_replace('/]=>\s+/', '] => <label>', ob_get_clean());
            }
        }else{
            foreach($param as $k => $v){
                echo $k>0 ? '<hr>' : '', print_r($v, true);
            }
        }
        echo '</pre>';
    }

    /**
     * 错误信息重置
     *
     * @param array $result 结果信息
     * @param array $failList 错误信息列表
     * @return array
     */
    public function responseError($result = array(), $failList = array()){
       if(!is_array($result)){
            $result = json_decode($result, true);
        }
        if(isset($result['code']) && $result['code'] != 200){
            unset($result['url']);
			if($result['code'] == 1002){
				unset($failList[1002]);
			}
            $result['code'] = $result;
            $result['errors'] = $failList;
            $result = $this->getError($result);
            return $result;
        }else{
            return $result;
        }
    }

    /**
     * 生成一个指定长度随机字符串
     * @param int $len
     * @return string
     */
    public static function createRand($len = 6) {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $result = '';
        $string = str_shuffle($string);
        for ($i = 0; $i < $len; $i++) {
            $result .= $string[mt_rand(0, strlen($string) - 1)];
        }
        return $result;
    }


}