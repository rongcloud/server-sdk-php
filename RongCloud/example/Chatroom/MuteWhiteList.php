<?php
/**
 * 聊天室全体禁言白名单
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室全体禁言白名单
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
 * 移除聊天室全体禁言白名单
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
 * 获取聊天室全体禁言列表白名单
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