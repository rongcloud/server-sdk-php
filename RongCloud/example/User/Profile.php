<?php

/**
 * 用户模块 用户标签
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 用户资料设置
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => 'ujadk90ha1', //用户id
        'userProfile' => [
            'name' => 'testName',
            'email' => 'tester@rongcloud.cn'
        ],  //用户基本信息
        'userExtProfile' => [
            'ext_Profile1' => 'testpro1'
        ]  //用户扩展信息
    ];
    $res = $RongSDK->getUser()->Profile()->set($params);
    Utils::dump("用户资料设置", $res);
}
set();

/**
 * 用户托管信息清除
 */
function clean()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], //用户id
    ];
    $res =  $RongSDK->getUser()->Profile()->clean($params);
    Utils::dump("用户托管信息清除", $res);
}
clean();

/**
 * 批量查询用户资料
 */
function batchQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], //用户id
    ];
    $res =  $RongSDK->getUser()->Profile()->batchQuery($params);
    Utils::dump("批量查询用户资料", $res);
}
batchQuery();

/**
 * 分页获取应用全部用户列表
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
