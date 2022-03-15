<?php
/**
 * 群组备注
 */
namespace RongCloud\Lib\Group\Remark;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Remark {

    /**
     * 群组模块 群组备注
     *
     * @var string
     */
    private $jsonPath = 'Lib/Group/Remark/';

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
     * 添加群组备注
     *
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'userId',//用户id
            'groupId'=> 'groupId',//群组id
            'remark'=> '备注'//群组备注
        ];
     * @return array
     */
    public function set(array $Group=[]){
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 删除群组备注
     *
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'groupId'=> 'targetUserid'//群组id
    ];
     * @return array
     */
    public function del(array $Group=[]){
        $conf = $this->conf['del'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     *获取群组备注
     * @param $User array
     * @param
     * $User = [
            'userId'=> 'ujadk90ha1',//用户id
            'groupId'=> 'groupId'//群组id
        ];
     * @return array
     * @return  array
     */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['remark']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}