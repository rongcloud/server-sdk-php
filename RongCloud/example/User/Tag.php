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
 * 添加用户标签
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',//用户id
        'tags'=> ['标签557','标签4']//用户标签
    ];
    $Block = $RongSDK->getUser()->Tag()->set($user);
    Utils::dump("添加标签",$Block);
}
set();

/**
 * 批量添加用户标签
 */
function batchset()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],//用户id
        'tags'=> ['标签567','标签2']//用户标签
    ];
    $Block =  $RongSDK->getUser()->Tag()->batchset($user);
    Utils::dump("批量添加标签",$Block);
}
batchset();

/**
 * 获取用户标签
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],//用户id
    ];
    $Block =  $RongSDK->getUser()->Tag()->get($user);
    Utils::dump("获取用户标签",$Block);
}
get();