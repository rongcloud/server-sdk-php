<?php
/**
 * 聊天室全局禁言
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室全局禁言
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
        'minute'=>30//禁言时长
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->add($chatroom);
    Utils::dump("添加聊天室全局禁言",$Ban);
}
add();

/**
 * 解除聊天室全局禁言
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
    ];
    $Ban = $RongSDK->getChatroom()->Ban()->remove($chatroom);
    Utils::dump("解除聊天室全局禁言",$Ban);
}
remove();

/**
 * 获取聊天室全局禁言列表
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