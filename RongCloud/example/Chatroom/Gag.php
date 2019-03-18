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
        'id'=> 'chatroom001',//聊天室 id
        'members'=> [
            ['id'=>'seal9901']//禁言人员 id
        ],
        'minute'=>30//禁言时长
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->add($chatroom);
    Utils::dump("添加聊天室成员禁言",$Gag);
}
add();

/**
 * 解除聊天室成员禁言
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'ujadk90ha',//聊天室 id
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->remove($chatroom);
    Utils::dump("解除聊天室成员禁言",$Gag);
}
remove();

/**
 * 获取聊天室成员禁言列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom001"//聊天室 id
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->getList($chatroom);
    Utils::dump("获取聊天室成员禁言列表",$Gag);
}
getList();