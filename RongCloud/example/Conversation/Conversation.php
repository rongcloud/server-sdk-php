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
    Utils::dump("Set user's session screen to Push",$result);
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
    Utils::dump("Set the user to receive Push notifications for a specific session",$result);
}
unmute();

/**
 * Set whether a conversation is pinned.
 */
function pinned()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $conversation = [
        'userId'=>'mka091amn',
        'conversationType'=>'1',
        'targetId'=>'adm1klnd',
        'setTop'=>'true'
    ];
    $result = $RongSDK->getConversation()->pinned($conversation);
    Utils::dump("Set whether a conversation is pinned",$result);
}
pinned();



