<?php
/**
 * Chatroom Keepalive
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add a chat room for live conversations
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->add($chatroom);
    Utils::dump("Add a private chat room",$Keeplive);
}
add();

/**
 * Delete chat room with keep-alive
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "chrmId001"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->remove($chatroom);
    Utils::dump("Delete the live chat room",$Keeplive);
}
remove();

/**
 * Get the chat room for preservation
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->getList($chatroom);
    Utils::dump("Get the chat room for life insurance",$Keeplive);
}
getList();