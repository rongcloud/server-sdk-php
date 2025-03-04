<?php

/**
 * Group Information Management Module
 */

namespace RongCloud\Lib\Entrust\Group;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Group
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
 * Validate configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
 * Create Group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'name' => 'name123',
 * 'owner' => 'admin',
 * 'userIds' => ['123','456'],
 * 'groupProfile' => ['introduction'=>'','announcement'=>'','portraitUrl'=>''],
 * 'permissions' => ['joinPerm'=>0,'removePerm'=>0,'memInvitePerm'=>0,'invitePerm'=>0,'profilePerm'=>0,'memProfilePerm'=>0],
 * 'groupExtProfile' => ['key'=>'value']
 * ]
 * @return array
 */
    public function create(array $param = [])
    {
        $modelName = 'create';
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
        if (isset($param['groupProfile']) && is_array($param['groupProfile'])) {
            $param['groupProfile'] = json_encode($param['groupProfile'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['permissions']) && is_array($param['permissions'])) {
            $param['permissions'] = json_encode($param['permissions'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['groupExtProfile']) && is_array($param['groupExtProfile'])) {
            $param['groupExtProfile'] = json_encode($param['groupExtProfile'], JSON_UNESCAPED_UNICODE);
        }
        $result = (new Request())->Request('entrust/group/create', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Set group information
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'name' => 'name123',
 * 'groupProfile' => ['introduction'=>'','announcement'=>'','portraitUrl'=>''],
 * 'permissions' => ['joinPerm'=>0,'removePerm'=>0,'memInvitePerm'=>0,'invitePerm'=>0,'profilePerm'=>0,'memProfilePerm'=>0],
 * 'groupExtProfile' => ['key'=>'value']
 * ]
 * @return array
 */
    public function update(array $param = [])
    {
        $modelName = 'update';
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
        if (isset($param['groupProfile']) && is_array($param['groupProfile'])) {
            $param['groupProfile'] = json_encode($param['groupProfile'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['permissions']) && is_array($param['permissions'])) {
            $param['permissions'] = json_encode($param['permissions'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['groupExtProfile']) && is_array($param['groupExtProfile'])) {
            $param['groupExtProfile'] = json_encode($param['groupExtProfile'], JSON_UNESCAPED_UNICODE);
        }
        $result = (new Request())->Request('entrust/group/profile/update', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Exit group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userIds' => ['123','456'],
 * 'isDelBan' => 1,
 * 'isDelWhite' => 1,
 * 'isDelFollowed' => 1
 * ]
 * @return array
 */
    public function quit(array $param = [])
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
        $result = (new Request())->Request('entrust/group/quit', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Disband group
 *
 * @param array $param = [
 * 'groupId' => '111'
 * ]
 * @return array
 */
    public function dismiss(array $param = [])
    {
        $modelName = 'groupId';
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
        $result = (new Request())->Request('entrust/group/dismiss', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Join group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userIds' => ['123','456']
 * ]
 * @return array
 */
    public function join(array $param = [])
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
        $result = (new Request())->Request('entrust/group/join', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Transfer group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'newOwner' => '222',
 * 'isQuit' => 0,
 * 'isDelBan' => 1,
 * 'isDelWhite' => 1,
 * 'isDelFollowed' => 1
 * ]
 * @return array
 */
    public function transferOwner(array $param = [])
    {
        $modelName = 'transferOwner';
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
        $result = (new Request())->Request('entrust/group/transfer/owner', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Group management import
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'name' => '222',
 * 'owner' => '222',
 * 'groupProfile' => ['introduction'=>'','announcement'=>'','portraitUrl'=>''],
 * 'permissions' => ['joinPerm'=>0,'removePerm'=>0,'memInvitePerm'=>0,'invitePerm'=>0,'profilePerm'=>0,'memProfilePerm'=>0],
 * 'groupExtProfile' => ['key'=>'value']
 * ]
 * @return array
 */
    public function import(array $param = [])
    {
        $modelName = 'create';
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
        if (isset($param['groupProfile']) && is_array($param['groupProfile'])) {
            $param['groupProfile'] = json_encode($param['groupProfile'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['permissions']) && is_array($param['permissions'])) {
            $param['permissions'] = json_encode($param['permissions'], JSON_UNESCAPED_UNICODE);
        }
        if (isset($param['groupExtProfile']) && is_array($param['groupExtProfile'])) {
            $param['groupExtProfile'] = json_encode($param['groupExtProfile'], JSON_UNESCAPED_UNICODE);
        }
        $result = (new Request())->Request('entrust/group/import', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }


    /**
 * Pagination query application group information
 *
 * @param array $param = [
 * 'pageToken' => '',
 * 'size' => 50,
 * 'order' => 1
 * ]
 * @return array
 */
    public function query(array $param = [])
    {
        $result = (new Request())->Request('entrust/group/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Paginated query for users added to a group
 *
 * @param array $param = [
 * 'userId' => '10',
 * 'role' => 0,
 * 'pageToken' => 'xxxx',
 * 'size' => 50,
 * 'order' => 1
 * ]
 * @return array
 */
    public function joinedQuery(array $param = [])
    {
        $modelName = 'joinedQuery';
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
        $result = (new Request())->Request('entrust/joined/group/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Batch query group information
 *
 * @param array $param = [
 * 'groupIds' => ['123','456'],
 * ]
 * @return array
 */
    public function profileQuery(array $param = [])
    {
        $modelName = 'profileQuery';
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
        $result = (new Request())->Request('entrust/group/profile/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }
}
