<?php
/**
 * Chat room message downgrade
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add in-app chat room downgrade message
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// Message type list
    ];
    $Demotion = $RongSDK->getChatroom()->Demotion()->add($chatroom);
    Utils::dump("添加应用内聊天室降级消息",$Demotion);
}
add();

/**
 * Remove application chat room downgrade message
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ['RC:TxtMsg01','RC:TxtMsg02']// Message type list
    ];
    $Demotion = $RongSDK->getChatroom()->Demotion()->remove($chatroom);
    Utils::dump("移除应用内聊天室降级消息",$Demotion);
}
remove();

/**
 * Get the downgrade message within the app chat room
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