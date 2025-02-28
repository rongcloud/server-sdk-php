<?php

/**
 * Group Information Management - Management Module Testing
 */
require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Set group administrator (Add group administrator)
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->add($param);
    Utils::dump("设置群管理员(添加群管理员)", $result);
}
add();

/**
 * Remove group administrator
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userIds' => ['C_U_1', 'C_U_2', 'C_U_3']
    ];
    $result = $RongSDK->getEntrust()->GroupManager()->remove($param);
    Utils::dump("移除群管理员", $result);
}
remove();