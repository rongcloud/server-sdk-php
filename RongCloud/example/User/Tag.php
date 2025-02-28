<?php
/**
 * // User Module User Tag
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Add user tag
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userId'=> 'ujadk90ha1',// User ID
        'tags'=> ['标签557','标签4']// // User tag
    ];
    $Block = $RongSDK->getUser()->Tag()->set($user);
    Utils::dump("添加标签",$Block);
}
set();

/**
 * // Batch add user tags
 */
function batchset()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],// // User ID
        'tags'=> ['标签567','标签2']// User tag
    ];
    $Block =  $RongSDK->getUser()->Tag()->batchset($user);
    Utils::dump("批量添加标签",$Block);
}
batchset();

/**
 * // Get user tags
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],// User ID
    ];
    $Block =  $RongSDK->getUser()->Tag()->get($user);
    Utils::dump("获取用户标签",$Block);
}
get();