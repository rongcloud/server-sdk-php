<?php

/**
 * 群组信息托管-管理模块
 */
namespace RongCloud\Lib\Entrust\Group\Manager;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Manager
{
    /**
     * 信息托管模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Entrust/';

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
     * Conversation constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * 设置群管理员(添加群管理员)
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userIds' => ['123','456']
     * ]
     * @return array
     */
    public function add(array $param = [])
    {
        $modelName = 'groupId_userIds';
        $error = (new Utils())->check([
            'api' => $this->conf['group'],
            'fail' => $this->conf['response']['fail'],
            'model' => $modelName,
            'verify' => $this->verify[$modelName],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/manager/add', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
     * 移除群管理员
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userIds' => ['123','456']
     * ]
     * @return array
     */
    public function remove(array $param = [])
    {
        $modelName = 'groupId_userIds';
        $error = (new Utils())->check([
            'api' => $this->conf['group'],
            'fail' => $this->conf['response']['fail'],
            'model' => $modelName,
            'verify' => $this->verify[$modelName],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/manager/remove', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }
}