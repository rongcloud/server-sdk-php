<?php
/**
 * Chat room message whitelist instance
 */

require "./../../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add chat room message whitelist
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ["RC:TxtMsg"]// Message type list
    ];
    $Message = $RongSDK->getChatroom()->Whitelist()->Message()->add($chatroom);
    Utils::dump("添加聊天室消息白名单",$Message);
}
add();

/**
 * Get the chat room message whitelist
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Message = $RongSDK->getChatroom()->Whitelist()->Message()->getList($chatroom);
    Utils::dump("获取聊天室消息白名单",$Message);
}
getList();

/**
 * Remove chat room message whitelist
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ["RC:TxtMsg"]// Message type list
    ];
    $Message = $RongSDK->getChatroom()->Whitelist()->Message()->remove($chatroom);
    Utils::dump("删除聊天室消息白名单",$Message);
}
remove();