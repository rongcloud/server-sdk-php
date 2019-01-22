<?php
/**
 * 敏感词管理
 * Date=> 2018/7/23
 * Time=> 11=>41
 */
namespace RongCloud\Lib\Sensitive;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;
class Sensitive
{

    /**
     * 敏感词模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Sensitive/';

    /**
     * 请求配置文件
     *
     * @var string
     */
    private $conf = "";

    /**
     * 校验配置文件
     *
     * @var string
     */
    private $verify = "";

    /**
     * Sensitive constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * 敏感词添加
     *
     * @param $Sensitive array 敏感词添加参数
     * @param
     * $Sensitive = [
                'replace'=> '***',//敏感词替换，最长不超过 32 个字符， 敏感词屏蔽可以为空
                'keyword'=>"abc",//敏感词
                'type'=>0// 0: 敏感词替换 1: 敏感词屏蔽
        ];
     * @return array
     */
    public function add(array $Sensitive=[]){
        $Sensitive['replace'] = isset($Sensitive['replace'])?$Sensitive['replace']:"";
        $conf = $this->conf['add'];
        $verify = $this->verify['rule'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'rule',
            'data'=> $Sensitive,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Sensitive = (new Utils())->rename($Sensitive, [
            'keyword'=> 'word',
            'replace'=> 'replaceWord'
        ]);
        if(!isset($Sensitive['type'])){
            $Sensitive['type'] = 1;
        }
        if($Sensitive['type'] == 1){
            unset($Sensitive['type']);
            unset($Sensitive['replaceWord']);
        }
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 敏感词删除
     *
     * @param $Sensitive array  敏感词删除参数
     * @param
     * $Sensitive = [
                'keywords'=>["bbb"]//删除敏感词列表
            ];
     * @return array
     */
    public function remove(array $Sensitive=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['sensitive'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'sensitive',
            'data'=> $Sensitive,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Sensitive = (new Utils())->rename($Sensitive, [
            'keywords'=> 'words',
        ]);
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 敏感词列表
     *
     * @param $Sensitive array 敏感词列表参数
     * @param
     * $Sensitive = [
                'type'=> 1,//敏感词类型，0: 敏感词替换， 1: 敏感词屏蔽， 为空获取全部
            ];
     * @return array
     */
    public function getList(array $Sensitive=[]){
        $Sensitive['type'] = isset($Sensitive['type'])?intval($Sensitive['type']):2;
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Sensitive);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

}