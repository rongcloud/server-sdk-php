<?php

/**
 * // Group Information Hosting - Backup Naming Module
 */
namespace RongCloud\Lib\Entrust\Group\RemarkName;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class RemarkName
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
 * // Configuration file validation
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
 * // Set the user-specified group name remark
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222',
 * 'remarkName' => 'rongcloud'
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
 * Delete the specified group name annotation for the user
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222'
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
 * // Query the specified group name for user remarks
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222'
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