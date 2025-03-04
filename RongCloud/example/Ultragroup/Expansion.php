<?php

/**
 * Supercluster module supercluster expansion message
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);
/**
 * Message Sending
 */
function set()
{
    // Connect to Singapore Data Center
    // RongCloud::$apiUrl = ['http://api.sg-light-api.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // The unique message identifier, which the server can obtain through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // The user ID for extended message delivery needs to be set.
        'groupId'          => 'tjw3zbMrU',             // Super group ID
        'busChannel'  => '',                     // Channel ID can be empty
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] // Custom message extension content, JSON structure, set in Key-Value format
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->set($message);
    Utils::dump("Message Sending", $res);
}
set();


function delete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // The unique message identifier ID, which the server can obtain through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // Need to set the extended message sending user Id.
        'groupId'          => 'tjw3zbMrU',             // Super group ID
        'busChannel'  => '',                     // The channel ID can be empty
        'extraKey'          => ['type1', 'type2']       // The Key value of the extension information to be deleted, with a maximum of 100 extension information items that can be deleted at once
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->delete($message);
    Utils::dump("delete", $res);
}
delete();

/**
 * Get supergroup extension message
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  // The unique message identifier ID, which can be obtained by the server through the full message routing function.
        'groupId'=>"aaa" ,// Super cluster ID
        'busChannel'=>"aaa" ,// Super Group Channel
        'pageNo' => 1                     // Page count, defaults to returning 300 extended information.
    ];
    $res = $RongSDK->getUltragroup()->Expansion()->getList($message);
    Utils::dump("Get supergroup extension message", $res);
}
getList();
