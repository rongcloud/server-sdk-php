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
    Utils::dump("Add a full room ban",$MuteAllMembers);
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
    Utils::dump("Unban the entire chat room",$MuteAllMembers);
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
    Utils::dump("Check the global mute status of the chat room",$MuteAllMembers);
}
check();

/**
 * Get the list of all banned words in the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $MuteAllMembers = $RongSDK->getChatroom()->MuteAllMembers()->getList(1, 50);
    Utils::dump("Get the list of banned words for the chat room
@param chatRoomId The ID of the chat room
@return List of banned words",$MuteAllMembers);
}
getList();