<?php

/**
 * // User module user instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * User registration
 */
function register()
{
    // // Connect to the Singapore data center
    // RongCloud::$apiUrl = ['http://api.sg-light-api.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'CHIQ1',
        'name' => 'PHPSDK', // Username
        'portrait' => '' // // User avatar
    ];
    $register = $RongSDK->getUser()->register($user);
    Utils::dump("用户注册", $register);
}

register();

/**
 * User information update
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', // User ID
        'name' => 'Maritn', // // Username
        'portrait' => 'http:// 7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' //User avatar
    ];
    $update = $RongSDK->getUser()->update($user);
    Utils::dump("用户信息更新", $update);
}

update();

/**
 * Retrieve user information
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', // User ID
    ];
    $res = $RongSDK->getUser()->get($user);
    Utils::dump("获取用户信息", $res);
}

get();

/**
 * // User logout
 */
function abandon()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', // // User ID
    ];
    $res = $RongSDK->getUser()->abandon($user);
    Utils::dump("用户注销", $res);
}

abandon();

/**
 * // Reactivate user ID
 */
function reactivate()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => ['55vW81Mni','kkj9o02'],
        'time' => 1623123911000
    ];
    $res = $RongSDK->getUser()->reactivate($user);
    Utils::dump("Token 失效", $res);
}
reactivate();

/**
 * // List of unsubscribed users
 */
function abandonQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'page' => 1, // Page number
        'size' => 10, // Page count
    ];
    $res = $RongSDK->getUser()->abandonQuery($params);
    Utils::dump("注销用户列表", $res);
}

abandonQuery();

/**
 * // Deactivate Activation
 */
function active()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', // // User ID
    ];
    $res = $RongSDK->getUser()->activate($user);
    Utils::dump("注销用户激活", $res);
}

active();

/**
 * // Query the user's group
 */
function getGroups()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => '55vW81Mni', // User ID
    ];
    $res = $RongSDK->getUser()->getGroups($user);
    Utils::dump("查询用户所在群组", $res);
}

getGroups();

/**
 * // Token invalid
 */
function expire()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => ['55vW81Mni','kkj9o02'],
        'time' => 1623123911000
    ];
    $res = $RongSDK->getUser()->expire($user);
    Utils::dump("Token 失效", $res);
}
expire();