<?php

/**
 * 群组信息托管模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

/**
 * 创建群组
 */
function testGroupCreate($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('创建群组失败,缺少必要参数 name', $result);

    $param['name'] = 'RC_NAME_1';
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('创建群组失败,缺少必要参数 owner', $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump('创建群组成功', $result);
}
testGroupCreate($RongSDK);

/**
 * 设置群组资料
 */
function testGroupUpdate($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->update($param);
    Utils::dump("设置群组资料失败,缺少必要参数 name", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'name' => 'RC_NAME_2',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->update($param);
    Utils::dump("设置群组资料成功", $result);
}
testGroupUpdate($RongSDK);

/**
 * 退出群组
 */
function testGroupQuit($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->quit($param);
    Utils::dump("退出群组失败,缺少必要参数 userIds", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->quit($param);
    Utils::dump("退出群组成功", $result);
}
testGroupQuit($RongSDK);

/**
 * 解散群组
 */
function testGroupDismiss($RongSDK)
{
    $param = [
        'groupId' => 'CHIQ_GROUP_2'
    ];
    $result = $RongSDK->getEntrust()->Group()->dismiss($param);
    Utils::dump("解散群组成功", $result);
}
testGroupDismiss($RongSDK);

/**
 * 加入群组
 */
function testGroupJoin($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->join($param);
    Utils::dump("加入群组失败,缺少必要参数 userIds", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456']
    ];
    $result = $RongSDK->getEntrust()->Group()->join($param);
    Utils::dump("加入群组成功", $result);
}
testGroupJoin($RongSDK);

/**
 * 转让群组
 */
function testGroupTransferOwner($RongSDK)
{
    $param = ['groupId' => 'CHIQ_GROUP_2'];
    $result = $RongSDK->getEntrust()->Group()->transferOwner($param);
    Utils::dump("转让群组失败,缺少必要参数 newOwner", $result);

    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'newOwner' => '123',
        'isQuit' => 0,
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->transferOwner($param);
    Utils::dump("转让群组成功", $result);
}
testGroupTransferOwner($RongSDK);

/**
 * 群组托管导入
 */
function testGroupImport($RongSDK)
{
    $param = ['name' => 'RC_NAME_1'];
    $result = $RongSDK->getEntrust()->Group()->import($param);
    Utils::dump("群组托管导入失败,缺少必要参数 groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->import($param);
    Utils::dump("群组托管导入成功", $result);
}
testGroupImport($RongSDK);

/**
 * 分页查询应用下群组信息
 */
function testGroupQuery($RongSDK)
{
    $param = [
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->query($param);
    Utils::dump("分页查询应用下群组信息成功", $result);
}
testGroupQuery($RongSDK);

/**
 * 分页查询用户加入的群组
 */
function testGroupJoinedQuery($RongSDK)
{
    $param = ['role' => 0];
    $result = $RongSDK->getEntrust()->Group()->joinedQuery($param);
    Utils::dump("分页查询用户加入的群组失败,缺少必要参数 userId", $result);

    $param = [
        'userId' => '10',
        'role' => 0,
        'pageToken' => 'xxxx',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->joinedQuery($param);
    Utils::dump("分页查询用户加入的群组成功", $result);
}
testGroupJoinedQuery($RongSDK);

/**
 * 批量查询群组资料
 */
function testGroupProfileQuery($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->Group()->profileQuery($param);
    Utils::dump("批量查询群组资料失败,缺少必要参数 groupIds", $result);

    $param = [
        'groupIds' => ['RC_GROUP_1', 'CHIQ_GROUP_2']
    ];
    $result = $RongSDK->getEntrust()->Group()->profileQuery($param);
    Utils::dump("批量查询群组资料成功", $result);
}
testGroupProfileQuery($RongSDK);

/**
 * 设置群管理员(添加群管理员)
 */
function testGroupManagerAdd($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupManager()->add($param);
    Utils::dump("设置群管理员(添加群管理员)失败,缺少必要参数 groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->add($param);
    Utils::dump("设置群管理员(添加群管理员)成功", $result);
}
testGroupManagerAdd($RongSDK);

/**
 * 移除群管理员
 */
function testGroupManagerRemove($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupManager()->remove($param);
    Utils::dump("移除群管理员失败,缺少必要参数 userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->remove($param);
    Utils::dump("移除群管理员成功", $result);
}
testGroupManagerRemove($RongSDK);

/**
 * 设置群成员资料
 */
function testGroupMemberSet($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->set($param);
    Utils::dump("设置群成员资料失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'nickname' => 'rongcloud',
        'extra' => 'xxxxxx'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->set($param);
    Utils::dump("设置群成员资料成功", $result);
}
testGroupMemberSet($RongSDK);

/**
 * 踢出群组
 */
function testGroupMemberKick($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->kick($param);
    Utils::dump("踢出群组失败,缺少必要参数 userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kick($param);
    Utils::dump("踢出群组成功", $result);
}
testGroupMemberKick($RongSDK);

/**
 * 指定用户踢出所有群组
 */
function testGroupMemberKickAll($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("指定用户踢出所有群组失败,缺少必要参数 userId", $result);

    $param = [
        'userId' => '111'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("指定用户踢出所有群组成功", $result);
}
testGroupMemberKickAll($RongSDK);

/**
 * 设置用户指定群特别关注用户
 */
function testGroupMemberFollow($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->follow($param);
    Utils::dump("设置用户指定群特别关注用户失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->follow($param);
    Utils::dump("设置用户指定群特别关注用户成功", $result);
}
testGroupMemberFollow($RongSDK);

/**
 * 删除用户指定群组中的特别关注用户
 */
function testGroupMemberUnFollow($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->unFollow($param);
    Utils::dump("删除用户指定群组中的特别关注用户失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->unFollow($param);
    Utils::dump("删除用户指定群组中的特别关注用户成功", $result);
}
testGroupMemberUnFollow($RongSDK);

/**
 * 查询用户指定群组特别关注成员列表
 */
function testGroupMemberGetFollowed($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("查询用户指定群组特别关注成员列表失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("查询用户指定群组特别关注成员列表成功", $result);
}
testGroupMemberGetFollowed($RongSDK);

/**
 * 分页获取群成员信息
 */
function testGroupMemberQuery($RongSDK)
{
    $param = [];
    $result = $RongSDK->getEntrust()->GroupMember()->query($param);
    Utils::dump("分页获取群成员信息失败,缺少必要参数 groupId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'type' => 0,
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->query($param);
    Utils::dump("分页获取群成员信息成功", $result);
}
testGroupMemberQuery($RongSDK);

/**
 * 获取指定群成员信息
 */
function testGroupMemberSpecificQuery($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("获取指定群成员信息失败,缺少必要参数 userIds", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("获取指定群成员信息成功", $result);
}
testGroupMemberSpecificQuery($RongSDK);

/**
 * 设置用户指定群组名称备注名
 */
function testGroupRemarkNameSet($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->set($param);
    Utils::dump("设置用户指定群组名称备注名失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'remarkName' => 'rongcloud'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->set($param);
    Utils::dump("设置用户指定群组名称备注名成功", $result);
}
testGroupRemarkNameSet($RongSDK);

/**
 * 设置用户指定群组名称备注名
 */
function testGroupRemarkNameDelete($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("设置用户指定群组名称备注名失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("设置用户指定群组名称备注名成功", $result);
}
testGroupRemarkNameDelete($RongSDK);

/**
 * 查询用户指定群组名称备注名
 */
function testGroupRemarkNameQuery($RongSDK)
{
    $param = ['groupId' => 'RC_GROUP_1'];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("查询用户指定群组名称备注名失败,缺少必要参数 userId", $result);

    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("查询用户指定群组名称备注名成功", $result);
}
testGroupRemarkNameQuery($RongSDK);
