<?php
/**
 * Chat room message distribution
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;


/**
 * Stop chat room message distribution
 */
function stop()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"// Chatroom ID
/* Chatroom ID */
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->stop($chatroom);
    Utils::dump("Stop chat room message distribution",$Demotion);
}
stop();

/**
 * Restore chat room message distribution
 */
function resume()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> "Txtmsg03"// Chatroom ID
    ];
    $Demotion = $RongSDK->getChatroom()->Distribute()->resume($chatroom);
    Utils::dump("Restore chat room message distribution",$Demotion);
}
resume();
