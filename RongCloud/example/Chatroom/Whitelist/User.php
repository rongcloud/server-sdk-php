<?php
/**
 * Chat Room Module User Whitelist Instance
 */


require "./../../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add chat room user whitelist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",// Chat room ID
        "members"=>[
            ["id"=>"user1"],//  User ID
            ["id"=>"user2"]
        ]
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->add($chatroom);
    Utils::dump("Add chat room user whitelist",$User);
}
add();

/**
 * Remove chat room user whitelist
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",// Chat room ID
        "members"=>[
           ["id"=>"user4"],//  User ID
           ["id"=>"user5"]
        ]
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->remove($chatroom);
    Utils::dump("Remove chat room user whitelist",$User);
}
remove();

/**
 * Get the chat room user whitelist
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",// chatroom id
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->getList($chatroom);
    Utils::dump("Get the chat room user whitelist",$User);
}
getList();