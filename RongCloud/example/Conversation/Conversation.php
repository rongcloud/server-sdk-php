<?php
/**
 * Conversation example
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;
/**
 * Set user's session screen to Push
 */
function mute()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $conversation = [
        'type'=> 'PRIVATE',// Conversation types: PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'Vu-oC0_LQ6kgPqltm_zYtI',// Session owner
        'targetId'=>'Vu-oC0_LQ6kgPqltm_zYtI'// Session ID
    ];
    $result = $RongSDK->getConversation()->mute($conversation);
    Utils::dump("Set user session screen push",$result);
}
mute();

/**
 * Set the user to receive Push notifications for a specific session
 */
function unmute()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $conversation = [
        'type'=> 'PRIVATE',// Session types PRIVATE, GROUP, DISCUSSION, SYSTEM
        'userId'=>'mka091amn',// Session owner
        'targetId'=>'adm1klnm'// Session ID
    ];
    $result = $RongSDK->getConversation()->unmute($conversation);
    Utils::dump("Set the user's session to receive Push notifications",$result);
}
unmute();
