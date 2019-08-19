<?php
/**
 * 用户关系 封禁用户
 */
namespace RongCloud\Lib\User\Tag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Tag {

    /**
     * 用户模块 用户标签
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Tag/';

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
     * 添加用户标签
     *
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'tags'=> ['标签1','标签2']//用户标签
        ];
     * @return array
     */
    public function set(array $User=[]){
        $conf = $this->conf['setTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['tag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 批量添加用户标签
     *
     * @param $User array
     * @param
     * $User = [
            'userIds'=> ['ujadk90ha1','ujadk90ha1'],//用户id 列表
            'tags'=> ['标签1','标签2']//用户标签
        ];
     * @return array
     */
    public function batchset(array $User=[]){
        $conf = $this->conf['batchSetTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['batchTag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *获取用户标签
     * @param $User array
     * @param
     * $User = [
            'userIds'=> ['ujadk90ha1','ujadk90ha1'],//用户id 列表
        ];
     * @return array
     * @return  array
     */
    public function get(array $User=[]){
        $conf = $this->conf['getTag'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['getTag']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}