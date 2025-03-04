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
 * Set group member information
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
    Utils::dump("Set group member information", $result);
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
    Utils::dump("Leave the group", $result);
}
kick();

/**
 * Specify the user to kick out all groups
 */
function kickAll()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'userId' => '111'
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->kickAll($param);
    Utils::dump("Specify the user to kick out all groups
@param user The user to be kicked out", $result);
}
kickAll();

/**
 * Set user-specified group special attention users
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
    Utils::dump("Set user-specified special attention users", $result);
}
follow();

/**
 * Remove the specified user from the group's special attention list
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
    Utils::dump("Remove a specific user from the specified group's special attention list", $result);
}
unFollow();

/**
 * Query the list of members in the specified group that the user particularly focuses on
 */
function getFollowed()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->getFollowed($param);
    Utils::dump("Query the user-specified group's specially focused member list", $result);
}
getFollowed();

/**
 * Get group member information by pagination
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
    Utils::dump("Get paginated member information", $result);
}
query();

/**
 * Get specified member information
 */
function specificQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['111', '222']
    ];
    $result = $RongSDK->getEntrust()->GroupMember()->specificQuery($param);
    Utils::dump("Retrieve specified member information", $result);
}
specificQuery();
