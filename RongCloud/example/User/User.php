<?php

/**
 * 用户模块 用户实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 用户注册
 */
function register()
{
    //连接新加坡数据中心
    //RongCloud::$apiUrl = ['http://api-sg01.ronghub.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'CHIQ1',
        'name' => 'PHPSDK', //用户名称
        'portrait' => '' //用户头像
    ];
    $register = $RongSDK->getUser()->register($user);
    Utils::dump("用户注册", $register);
}

register();

/**
 * 用户信息更新
 */
function update()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', //用户id
        'name' => 'Maritn', //用户名称
        'portrait' => 'http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982' //用户头像
    ];
    $update = $RongSDK->getUser()->update($user);
    Utils::dump("用户信息更新", $update);
}

update();

/**
 * 获取用户信息
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', //用户id
    ];
    $res = $RongSDK->getUser()->get($user);
    Utils::dump("获取用户信息", $res);
}

get();

/**
 * 用户注销
 */
function abandon()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', //用户id
    ];
    $res = $RongSDK->getUser()->abandon($user);
    Utils::dump("用户注销", $res);
}

abandon();

/**
 * 注销用户列表
 */
function abandonQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'page' => 1, //页码
        'size' => 10, //分页条数
    ];
    $res = $RongSDK->getUser()->abandonQuery($params);
    Utils::dump("注销用户列表", $res);
}

abandonQuery();

/**
 * 注销激活
 */
function active()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => 'ujadk90ha', //用户id
    ];
    $res = $RongSDK->getUser()->activate($user);
    Utils::dump("注销用户激活", $res);
}

active();

/**
 * 查询用户所在群组
 */
function getGroups()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $user = [
        'id' => '55vW81Mni', //用户id
    ];
    $res = $RongSDK->getUser()->getGroups($user);
    Utils::dump("查询用户所在群组", $res);
}

getGroups();

/**
 * Token 失效
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