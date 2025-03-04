<?php
/**
 * User module blacklist instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add to blacklist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'blacklist'=> ['kkj9o01'] // List of personnel to be added to the blacklist
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->add($user);
    Utils::dump("添加黑名单",$Blacklist);
}
add();

/**
 * Remove blacklist
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'blacklist'=> ['kkj9o02'] // List of personnel requiring removal from the blacklist
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->remove($user);
    Utils::dump("移除黑名单",$Blacklist);
}
remove();

/**
 * User blacklist
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',// User ID
        'size'=> 1000,// @param pageSize The number of rows per page when fetching the blacklist user list, default is 1000 if not provided, maximum does not exceed 1000
        'pageToken'=> ''// Pagination information, the previous request returns next, no pagination processing when not transmitting, defaults to fetching the first 1000 user lists, sorted in reverse order by blacklist addition time.
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->getList($user);
    Utils::dump("用户黑名单列表",$Blacklist);
}
getList();