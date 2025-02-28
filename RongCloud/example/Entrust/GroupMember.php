<?php

/**
 * Group Information Hosting - Member Module Testing
 */
require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Set group member information
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'nickname' => 'rongcloud',
        'extra' => 'xxxxxx'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->set($param);
    Utils::dump("设置群成员资料", $result);
}
set();

/**
 * Kick out of the group
 */
function kick()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['123', '456'],
        'isDelBan' => 1,
        'isDelWhite' => 1,
        'isDelFollowed' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kick($param);
    Utils::dump("踢出群组", $result);
}
kick();

/**
 * // Specify the user to kick out all groups
 */
function kickAll()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'userId' => '111'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("指定用户踢出所有群组", $result);
}
kickAll();

/**
 * // Set user-specified group special attention users
 */
function follow()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->follow($param);
    Utils::dump("设置用户指定群特别关注用户", $result);
}
follow();

/**
 * // Remove the specified user from the group's special attention list
 */
function unFollow()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'followUserIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->unFollow($param);
    Utils::dump("删除用户指定群组中的特别关注用户", $result);
}
unFollow();

/**
 * // Query the list of members in the specified group that the user particularly focuses on
 */
function getFollowed()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("查询用户指定群组特别关注成员列表", $result);
}
getFollowed();

/**
 * // Get group member information by pagination
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'type' => 0,
        'pageToken' => '',
        'size' => 50,
        'order' => 1
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->query($param);
    Utils::dump("分页获取群成员信息", $result);
}
query();

/**
 * // Get specified member information
 */
function specificQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("获取指定群成员信息", $result);
}
specificQuery();
