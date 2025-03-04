<?php
/**
 * Push instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Broadcast Message
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $sensitive = [
        'platform'=> ['ios','android'],// Target operating system
        'fromuserid'=>'mka091amn',// Recipient User ID
        'audience'=>['is_to_all'=>true],// Push conditions, including: tag, userid, is_to_all.
        'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],// Send message content
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    $result = $RongSDK->getPush()->broadcast($sensitive);
    Utils::dump("Broadcast message",$result);
}
broadcast();

/**
 * Push notifications
 */
function push()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $sensitive = [
        'platform'=> ['ios','android'],// Target operating system
        'audience'=>['is_to_all'=>true],// Push conditions, including: tag, userid, is_to_all.
        'notification'=>['alert'=>"this is a push"]
    ];
    $result = $RongSDK->getPush()->push($sensitive);
    Utils::dump("Push notification",$result);
}
push();

