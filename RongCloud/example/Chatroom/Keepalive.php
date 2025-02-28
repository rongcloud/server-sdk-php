<?php
/**
 * // Chatroom Keepalive
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Add a chat room for live conversations
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->add($chatroom);
    Utils::dump("添加保活聊天室",$Keeplive);
}
add();

/**
 * // Delete chat room with keep-alive
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "chrmId001"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->remove($chatroom);
    Utils::dump("删除保活聊天室",$Keeplive);
}
remove();

/**
 * // Get the chat room for preservation
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->getList($chatroom);
    Utils::dump("获取保活聊天室",$Keeplive);
}
getList();