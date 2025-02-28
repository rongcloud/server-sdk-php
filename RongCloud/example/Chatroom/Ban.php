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
 * // Add global chat room ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']// // Personnel ID
        ],
        'minute'=>30// // Forbidden duration
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->add($chatroom);
    Utils::dump("添加聊天室全局禁言",$Ban);
}
add();

/**
 * // Unblock global chat room restrictions
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']// // Person ID
        ],
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->remove($chatroom);
    Utils::dump("解除聊天室全局禁言",$Ban);
}
remove();

/**
 * // Get the global banned word list of the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Ban = $RongSDK->getChatroom()->Ban()->getList($chatroom);
    Utils::dump("获取聊天室全局禁言列表",$Ban);
}
getList();