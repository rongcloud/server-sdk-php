<?php

/**
 * // Group information module test
 */
require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;


/**
 * // Create a group
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->Group()->create($param);
    Utils::dump("创建群组", $result);
}
create();

/**
 * // Set group resources
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'name' => 'RC_NAME_2',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->update($param);
    Utils::dump("设置群组资料", $result);
}
update();

/**
 * // Exit group
 */
function quit()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->quit($param);
    Utils::dump("退出群组", $result);
}
quit();

/**
 * // Disband group
 */
function dismiss()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'CHIQ_GROUP_2'
    ];
    $result = $RongSDK->getEntrust()->Group()->dismiss($param);
    Utils::dump("解散群组", $result);
}
dismiss();

/**
 * Join the group
 */
function groupJoin()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'userIds' => ['123', '456']
    ];
    $result = $RongSDK->getEntrust()->Group()->join($param);
    Utils::dump("加入群组", $result);
}
groupJoin();

/**
 * // Transfer group
 */
function transferOwner()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'CHIQ_GROUP_2',
        'newOwner' => '123',
        'isQuit' => 0,
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->transferOwner($param);
    Utils::dump("转让群组", $result);
}
transferOwner();

/**
 * // Group hosting import
 */
function import()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'name' => 'RC_NAME_1',
        'owner' => 'RC_OWNER_1',
        'groupProfile' => ['introduction' => 'i', 'announcement' => 'a', 'portraitUrl' => ''],
        'permissions' => ['joinPerm' => 0, 'removePerm' => 0, 'memInvitePerm' => 0, 'invitePerm' => 0, 'profilePerm' => 0, 'memProfilePerm' => 0],
        'groupExtProfile' => ['key' => 'value']
    ];
    $result = $RongSDK->getEntrust()->Group()->import($param);
    Utils::dump("群组托管导入", $result);
}
import();

/**
 * // Query application group information under pagination
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->query($param);
    Utils::dump("分页查询应用下群组信息", $result);
}
query();

/**
 * // Pagination query for users added to the group
 */
function joinedQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'userId' => '10',
        'role' => 0,
        'pageToken' => 'xxxx',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->Group()->joinedQuery($param);
    Utils::dump("分页查询用户加入的群组", $result);
}
joinedQuery();

/**
 * // Batch query group data
 */
function profileQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupIds' => ['RC_GROUP_1', 'CHIQ_GROUP_2']
    ];
    $result = $RongSDK->getEntrust()->Group()->profileQuery($param);
    Utils::dump("批量查询群组资料", $result);
}
profileQuery();
