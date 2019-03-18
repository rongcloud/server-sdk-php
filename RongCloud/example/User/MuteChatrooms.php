<?php
/**
 * 聊天室成员禁言
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室成员禁言
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']//禁言人员 id
        ],
        'minute'=>30//禁言时长
    ];
    $MuteChatrooms = $RongSDK->getUser()->MuteChatrooms()->add($chatroom);
    Utils::dump("添加聊天室成员禁言",$MuteChatrooms);
}
add();

/**
 * 解除聊天室成员禁言
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
    ];
    $MuteChatrooms = $RongSDK->getUser()->MuteChatrooms()->remove($chatroom);
    Utils::dump("解除聊天室成员禁言",$MuteChatrooms);
}
remove();

/**
 * 获取聊天室成员禁言列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        
    ];
    $MuteChatrooms = $RongSDK->getUser()->MuteChatrooms()->getList($chatroom);
    Utils::dump("获取聊天室成员禁言列表",$MuteChatrooms);
}
getList();