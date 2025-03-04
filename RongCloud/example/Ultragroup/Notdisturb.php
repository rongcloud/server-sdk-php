<?php
/**
 * Supergroup mute notifications
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Set super group do not disturb
 */
function set()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>"",
        "unpushLevel"=>1
        // Do Not Disturb Level
        // -1: All message notifications
        // 0: Not set (When the user has not set this state, it is the default state for all notifications. In this state, if a super group default state is set, the super group's default settings will be used as the standard)
        // 1: Only notify for @ messages, including @specific users and @everyone
        // Only notify the specified user with @, and only notify the user specified by @.
        // //@Zhang San will receive the push notification, @all will not receive the push notification.
        // This is a sample comment
/* 
 * This is a multi-line comment
 * @param {string} input - The input string to process
 */
        // Only notify @all members, and only receive push messages from @everyone
        // 5: No notifications will be received, even if it is an @ message.
    ];
    $result = $RongSDK->getUltragroup()->Notdisturb()->set($group);
    Utils::dump("设置超级群免打扰",$result);
}
set();
/**
 * Query super group mute
 */
function get()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>"",
    ];
    $result = $RongSDK->getUltragroup()->Notdisturb()->get($group);
    Utils::dump("查询超级群免打扰",$result);
}
get();



