<?php
/**
 * 聊天室保活
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加保活聊天室
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->add($chatroom);
    Utils::dump("添加保活聊天室",$Keeplive);
}
add();

/**
 * 删除保活聊天室
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "chrmId001"
    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->remove($chatroom);
    Utils::dump("删除保活聊天室",$Keeplive);
}
remove();

/**
 * 获取保活聊天室
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [

    ];
    $Keeplive = $RongSDK->getChatroom()->Keepalive()->getList($chatroom);
    Utils::dump("获取保活聊天室",$Keeplive);
}
getList();