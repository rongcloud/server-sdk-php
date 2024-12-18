<?php

/**
 * 群组信息托管-成员模块
 */
namespace RongCloud\Lib\Entrust\Group\Member;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Member
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
     * 设置群成员资料
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222',
     *   'nickname' => 'rongcloud',
     *   'extra' => 'xxxxxx'
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
     * 踢出群组
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userIds' => ['123','456'],
     *   'isDelBan' => 1,
     *   'isDelWhite' => 1,
     *   'isDelFollowed' => 1
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
     * 指定用户踢出所有群组
     *
     * @param array $param = [
     *   'userId' => '111'
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
     * 设置用户指定群特别关注用户
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222',
     *   'followUserIds' => ['111','222']
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
     * 删除用户指定群组中的特别关注用户
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222',
     *   'followUserIds' => ['111','222']
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
     * 查询用户指定群组特别关注成员列表
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userId' => '222'
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
     * 分页获取群成员信息
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'type' => 0,
     *   'pageToken' => '',
     *   'size' => 50,
     *   'order' => 1
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
     * 获取指定群成员信息
     *
     * @param array $param = [
     *   'groupId' => '111',
     *   'userIds' => ['123','456']
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