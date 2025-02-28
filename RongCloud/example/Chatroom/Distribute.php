<?php
/**
 * // Chat room message distribution
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;


/**
 * // Stop chat room message distribution
 */
function stop()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"// // Chatroom ID
/* Chatroom ID */
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->stop($chatroom);
    Utils::dump("停止聊天室消息分发",$Demotion);
}
stop();

/**
 * Restore chat room message distribution
 */
function resume()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"// // Chatroom ID
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->resume($chatroom);
    Utils::dump("恢复聊天室消息分发",$Demotion);
}
resume();
