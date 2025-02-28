<?php

/**
 * Group Information Management - Member Module
 */
namespace RongCloud\Lib\Entrust\Group\Member;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Member
{
    /**
 * // Information hosting module path
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
 * // Configuration file for verification
 *
 * @var string
 *
 */
    private $verify = '';

    /**
 * // Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Set group member information
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222',
 * 'nickname' => 'rongcloud',
 * 'extra' => 'xxxxxx'
 * ]
 * @return array
 */
    public function set(array $param = [])
    {
        $error = (new Utils())->check([
            'api' => $this->conf['member'],
            'fail' => $this->conf['response']['fail'],
            'model' => 'set',
            'verify' => $this->verify['memberSet'],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/member/set', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Remove from group
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
    public function kick(array $param = [])
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
        $result = (new Request())->Request('entrust/group/member/kick', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }
    
    /**
 * // Specify the user to exit all groups
 *
 * @param array $param = [
 * 'userId' => '111'
 * ]
 * @return array
 */
    public function kickAll(array $param = [])
    {
        $modelName = 'kickAll';
        $error = (new Utils())->check([
            'api' => $this->conf['member'],
            'fail' => $this->conf['response']['fail'],
            'model' => $modelName,
            'verify' => $this->verify[$modelName],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/member/kick/all', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Set user-specified group to follow particular users
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222',
 * 'followUserIds' => ['111','222']
 * ]
 * @return array
 */
    public function follow(array $param = [])
    {
        $error = (new Utils())->check([
            'api' => $this->conf['member'],
            'fail' => $this->conf['response']['fail'],
            'model' => 'follow',
            'verify' => $this->verify['memberFollow'],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/member/follow', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Delete the specified special follow users in the user-defined group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222',
 * 'followUserIds' => ['111','222']
 * ]
 * @return array
 */
    public function unFollow(array $param = [])
    {
        $error = (new Utils())->check([
            'api' => $this->conf['member'],
            'fail' => $this->conf['response']['fail'],
            'model' => 'follow',
            'verify' => $this->verify['memberFollow'],
            'data' => $param
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request('entrust/group/member/unfollow', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of members with special attention in the user-specified group
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userId' => '222'
 * ]
 * @return array
 */
    public function getFollowed(array $param = [])
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
        $result = (new Request())->Request('entrust/group/member/followed/get', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * // Get paginated member information
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'type' => 0,
 * 'pageToken' => '',
 * 'size' => 50,
 * 'order' => 1
 * ]
 * @return array
 */
    public function query(array $param = [])
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
        $result = (new Request())->Request('entrust/group/member/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    /**
 * Retrieve specified group member information
 *
 * @param array $param = [
 * 'groupId' => '111',
 * 'userIds' => ['123','456']
 * ]
 * @return array
 */
    public function specificQuery(array $param = [])
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
        $result = (new Request())->Request('entrust/group/member/specific/query', $param);
        $result = (new Utils())->responseError($result, $this->conf['response']['fail']);
        return $result;
    }

    
}