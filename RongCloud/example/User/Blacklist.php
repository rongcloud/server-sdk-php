<?php
/**
 * 用户模块 黑名单实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加黑名单
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'blacklist'=> ['kkj9o01'] //需要添加黑名单的人员列表
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->add($user);
    Utils::dump("添加黑名单",$Blacklist);
}
add();

/**
 * 移除黑名单
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
        'blacklist'=> ['kkj9o02'] //需要移除黑名单的人员列表
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->remove($user);
    Utils::dump("移除黑名单",$Blacklist);
}
remove();

/**
 * 用户黑名单列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $user = [
        'id'=> 'ujadk90ha',//用户 id
    ];
    $Blacklist = $RongSDK->getUser()->Blacklist()->getList($user);
    Utils::dump("用户黑名单列表",$Blacklist);
}
getList();