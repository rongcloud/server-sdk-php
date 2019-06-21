<?php
/**
 *聊天室消息白名单实例
 */

require "./../../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室消息白名单
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ["RC:TxtMsg"]//消息类型列表
    ];
    $Message = $RongSDK->getChatroom()->Whitelist()->Message()->add($chatroom);
    Utils::dump("添加聊天室消息白名单",$Message);
}
add();

/**
 * 获取聊天室消息白名单
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
 * 删除聊天室消息白名单
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'msgs'=> ["RC:TxtMsg"]//消息类型列表
    ];
    $Message = $RongSDK->getChatroom()->Whitelist()->Message()->remove($chatroom);
    Utils::dump("删除聊天室消息白名单",$Message);
}
remove();