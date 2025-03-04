<?php
/**
 * Chatroom member banned speech
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add chat room member mute
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'chatroom001',// Chat room id
        'members'=> [
            ['id'=>'seal9901']// Forbidden personnel id
        ],
        'minute'=>30// Forbidden utterance duration
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->add($chatroom);
    Utils::dump("添加聊天室成员禁言",$Gag);
}
add();

/**
 * Unban chat room member
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'ujadk90ha',// Chat room id
        'members'=> [
            ['id'=>'seal9901']// Personnel ID
        ],
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->remove($chatroom);
    Utils::dump("解除聊天室成员禁言",$Gag);
}
remove();

/**
 * Get the list of muted members in the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom001"// chatroom id
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->getList($chatroom);
    Utils::dump("获取聊天室成员禁言列表",$Gag);
}
getList();