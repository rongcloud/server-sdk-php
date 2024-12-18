<?php

/**
 * 群组信息托管-备注名模块
 */
namespace RongCloud\Lib\Entrust\Group\RemarkName;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class RemarkName
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
     * 设置用户指定群组名称备注名
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222',
     *   'remarkName' => 'rongcloud'
     * ]
     * @return array
     */
    public function set(array $param = [])
    {
        $error = (new Utils())->check([
            'api' => $this->conf['remarkName'],
            'fail' => $this->conf['response']['fail'],
            'model' => 'set',
            'verify' => $this->verify['remarkNameSet'],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/remarkname/set', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
     * 删除用户指定群组名称备注名
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222'
     * ]
     * @return array
     */
    public function delete(array $param = [])
    {
        $modelName = 'groupId_userId';
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
        $result = (new Request())->Request('entrust/group/remarkname/delete', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
     * 查询用户指定群组名称备注名
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222'
     * ]
     * @return array
     */
    public function query(array $param = [])
    {
        $modelName = 'groupId_userId';
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
        $result = (new Request())->Request('entrust/group/remarkname/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }
}