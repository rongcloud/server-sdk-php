<?php
/**
 * 聊天室消息降级
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加应用内聊天室降级消息
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// 消息类型列表
    ];
    $Demotion = $RongSDK->getChatroom()->Demotion()->add($chatroom);
    Utils::dump("添加应用内聊天室降级消息",$Demotion);
}
add();

/**
 * 移除应用内聊天室降级消息
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ['RC:TxtMsg01','RC:TxtMsg02']// 消息类型列表
    ];
    $Demotion = $RongSDK->getChatroom()->Demotion()->remove($chatroom);
    Utils::dump("移除应用内聊天室降级消息",$Demotion);
}
remove();

/**
 * 获取应用内聊天室降级消息
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Demotion = $RongSDK->getChatroom()->Demotion()->getList($chatroom);
    Utils::dump("获取应用内聊天室降级消息",$Demotion);
}
getList();