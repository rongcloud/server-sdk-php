<?php

/**
 * Group Information Trusteeship - Management Module
 */
namespace RongCloud\Lib\Entrust\Group\Manager;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Manager
{
    /**
 * Information hosting module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Entrust/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Configuration file for validation
 *
 * @var string
 */
    private $verify = '';

    /**
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Set group administrator (add group administrator)
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userIds' => ['123','456']
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
 * Remove group administrator
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userIds' => ['123','456']
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