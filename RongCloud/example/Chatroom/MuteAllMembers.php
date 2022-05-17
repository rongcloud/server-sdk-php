<?php
/**
 * 聊天室全体禁言
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室全体禁言
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->add($chatroom);
    Utils::dump("添加聊天室全体禁言",$MuteAllMembers);
}
add();

/**
 * 解除聊天室全体禁言
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->remove($chatroom);
    Utils::dump("解除聊天室全体禁言",$MuteAllMembers);
}
remove();

/**
 * 聊天室全体禁言状态检查
 */
function check()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->check($chatroom);
    Utils::dump("聊天室全体禁言状态检查",$MuteAllMembers);
}
check();

/**
 * 获取聊天室全体禁言列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->getList(1, 50);
    Utils::dump("获取聊天室全体禁言列表",$MuteAllMembers);
}
getList();