<?php
/**
 * Mute all chatrooms
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add global chat room ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']// Personnel ID
        ],
        'minute'=>30// Forbidden duration
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->add($chatroom);
    Utils::dump("Add global chat room ban",$Ban);
}
add();

/**
 * Unblock global chat room restrictions
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']// Person ID
        ],
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->remove($chatroom);
    Utils::dump("Unlock global chat room restrictions",$Ban);
}
remove();

/**
 * Get the global banned word list of the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Ban = $RongSDK->getChatroom()->Ban()->getList($chatroom);
    Utils::dump("Get the global banned words list for the chat room",$Ban);
}
getList();