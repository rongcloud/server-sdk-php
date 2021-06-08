<?php

/**
 * 用户单聊禁言
 */

namespace RongCloud\Lib\User\Chat;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Utils;

class Ban
{

    /**
     * 用户模块用户单聊禁言路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Chat/';

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
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
     * 设置用户单聊禁言
     *
     * @param $User array 设置用户单聊禁言参数
     * @param
     * $User = [
            'id'    => ['ujadk90ha1'],  //被禁言用户 Id，支持批量设置，最多不超过 1000 个。
            'state' => 1,               //禁言状态，0 解除禁言、1 添加禁言
            'type'  => 'PERSON'         //会话类型，目前支持单聊会话 PERSON
        ];
     * @return array
     */
    public function set(array $User = [])
    {
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'user',
            'data' => $User,
            'verify' => $this->verify['set']
        ]);
        if ($error) return $error;
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $bodyParameter = (new Request())->getQueryFields($User);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }

    /**
     *查询禁言用户列表
     *
     * @param $param array 查询禁言用户列表参数
     * @param
     * $param = [
            'num'    => 100,        //获取行数，默认为 100，最大支持 200 个。
            'offset' => 0,          //查询开始位置，默认为 0。
            'type'   => 'PERSON'    //会话类型，目前支持单聊会话 PERSON
        ];
     * @return  array
     */
    public function getList(array $param = [])
    {
        $conf = $this->conf['getList'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'param',
            'data' => $param,
            'verify' => $this->verify['getList']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $param);
        $bodyParameter = (new Request())->getQueryFields($param);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }
}
