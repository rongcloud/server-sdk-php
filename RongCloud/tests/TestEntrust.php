<?php

/**
 * // Group information hosting module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

/**
 * Create a group
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
 * // Set group resources
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
 * Exit the group
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
 * // Dissolve group
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
 * Join the group
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
 * Transfer group
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
 * // Group hosting import
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
 * // Pagination query application group information
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
 * // Query users added to a group by page
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
 * // Batch query group data
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
 * // Set group administrator (Add group administrator)
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
 * Remove group administrator
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
 * // Set member information
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
 * // Exit group
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
 * // Specify the user to kick out all groups
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
 * // Set user-specified group special attention user
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
 * // Remove a specific user from the specified group's special attention list
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
 * // Query the list of members in the user-specified group with special attention
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
 * // Retrieve member information by pagination
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
 * // Get specified member information
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
 * // Set the user-specified group name as the backup name
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
 * // Set the user-specified group name annotation
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
 * // Query the specified group name annotation
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
