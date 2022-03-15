<?php
/**
 * 用户备注
 */
namespace RongCloud\Lib\User\Remark;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Remark {

    /**
     * 用户模块 用户备注
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Remark/';

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
     * User constructor.
     */
    function __construct()
    {
        //初始化请求配置和校验文件路径
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
     * 添加用户备注
     *
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'remark'=> [
                        ["id"=>'userid',"remark"=>'备注2'],
                        ["id"=>'userid2',"remark"=>'备注2']
                    ]//用户备注
        ];
     * @return array
     */
    public function set(array $User=[]){
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 删除用户备注
     *
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'targetId'=> 'targetUserid'//用户备注
    ];
     * @return array
     */
    public function del(array $User=[]){
        $conf = $this->conf['del'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *获取用户备注
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'size'=> 50 //默认 50
            'page' => 1 //默认首页
        ];
     * @return array
     * @return  array
     */
    public function get(array $User=[]){
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}