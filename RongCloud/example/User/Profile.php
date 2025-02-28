<?php

/**
 * // User Module User Label
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * User profile settings
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => 'ujadk90ha1', // User ID
        'userProfile' => [
            'name' => 'testName',
            'email' => 'tester@rongcloud.cn'
        ],  // User basic information
        'userExtProfile' => [
            'ext_Profile1' => 'testpro1'
        ]  // User extension information
    ];
    $res = $RongSDK->getUser()->Profile()->set($params);
    Utils::dump("用户资料设置", $res);
}
set();

/**
 * // Clear user custody information
 */
function clean()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
    ];
    $res =  $RongSDK->getUser()->Profile()->clean($params);
    Utils::dump("用户托管信息清除", $res);
}
clean();

/**
 * // Batch query user data
 */
function batchQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // // User ID
    ];
    $res =  $RongSDK->getUser()->Profile()->batchQuery($params);
    Utils::dump("批量查询用户资料", $res);
}
batchQuery();

/**
 * // Paginate to retrieve the full list of application users
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'page' => 1,
        'size' => 20,
        'order' => 0
    ];
    $res =  $RongSDK->getUser()->Profile()->query($params);
    Utils::dump("分页获取应用全部用户列表", $res);
}
query();
