<?php
/**
 * Chatroom full ban whitelist
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add the chat room's entire ban list to the whitelist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom",
        "members"=>[
            ["id"=>"user1"],
            ["id"=>"user2"],
        ]
    ];
    $MuteWhiteList = $RongSDK->getChatroom()->MuteWhiteList()->add($chatroom);
    Utils::dump("添加聊天室全体禁言白名单",$MuteWhiteList);
}
add();

/**
 * Remove the chat room's global ban whitelist
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom",
        "members"=>[
            ["id"=>"user3"],
            ["id"=>"user4"],
        ]
    ];
    $MuteWhiteList = $RongSDK->getChatroom()->MuteWhiteList()->remove($chatroom);
    Utils::dump("移除聊天室全体禁言白名单",$MuteWhiteList);
}
remove();

/**
 * Get the whitelist of the chat room's global mute list
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom",
    ];
    $MuteWhiteList = $RongSDK->getChatroom()->MuteWhiteList()->getList($chatroom);
    Utils::dump("获取聊天室全体禁言列表白名单",$MuteWhiteList);
}
getList();