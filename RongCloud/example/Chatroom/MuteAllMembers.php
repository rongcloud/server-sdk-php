<?php
/**
 * Chatroom-wide ban
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add a chat room-wide ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->add($chatroom);
    Utils::dump("Add a chat room-wide ban",$MuteAllMembers);
}
add();

/**
 * Unmute all participants in the chat room
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->remove($chatroom);
    Utils::dump("Unmute all participants in the chat room",$MuteAllMembers);
}
remove();

/**
 * Check the status of the entire chat room's mute state
 */
function check()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom"
    ];
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->check($chatroom);
    Utils::dump("Check the status of the entire chat room's mute state",$MuteAllMembers);
}
check();

/**
 * Get the list of all banned words in the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->getList(1, 50);
    Utils::dump("Get the list of all banned words in the chat room",$MuteAllMembers);
}
getList();