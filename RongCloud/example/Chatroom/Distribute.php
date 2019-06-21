<?php
/**
 * 聊天室消息分发
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;


/**
 * 停止聊天室消息分发
 */
function stop()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"//聊天室 id
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->stop($chatroom);
    Utils::dump("停止聊天室消息分发",$Demotion);
}
stop();

/**
 * 恢复聊天室消息分发
 */
function resume()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"//聊天室 id
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->resume($chatroom);
    Utils::dump("恢复聊天室消息分发",$Demotion);
}
resume();
