<?php

/**
 * Message module two-person message instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Two-person message sending
 */
function set()
{
    // Connect to the Singapore Data Center
    // RongCloud::$apiUrl = ['http://api.sg-light-api.com/'];
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // Message unique identifier, the server can obtain it through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // Need to set the extended message delivery user Id.
        'targetId'          => 'tjw3zbMrU',             // Target ID, depending on the conversationType, could be a user ID or a group ID.
        'conversationType'  => '1',                     // Conversation type, one-on-one chat is 1, group chat is 3, only supports single chat and group chat types.
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',],//  Custom message extension content, JSON structure, set in Key, Value format
        'isSyncSender'      => 0                        // Whether the sender accepts the terminal user's online status, 0 indicates not accepting, 1 indicates accepting, default is 0 not accepting
    ];
    $res = $RongSDK->getMessage()->Expansion()->set($message);
    Utils::dump("Set message extension", $res);
}
set();

/**
 * Send different content messages to multiple users
 */
function delete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // The unique message identifier, which can be obtained by the server through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // Set the extended message sending user Id.
        'targetId'          => 'tjw3zbMrU',             // Target ID, depending on the conversationType, could be a user ID or a group ID.
        'conversationType'  => '1',                     // Conversation type, one-on-one conversation is 1, group conversation is 3, only supports single chat and group conversation types.
        'extraKey'          => ['type1', 'type2'],       // The key value of the extension information to be deleted, with a maximum of 100 extension information items that can be deleted at once
        'isSyncSender'      => 0                        // Terminal user online status, whether the sender accepts this setting status, 0 indicates not accepted, 1 indicates accepted, default is 0 not accepted
    ];
    $res = $RongSDK->getMessage()->Expansion()->delete($message);
    Utils::dump("Delete message extension", $res);
}
delete();

/**
 * Two-person status message sending
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  // The unique message identifier, which can be obtained by the server through the full message routing function.
        'pageNo' => 1                     // Page count, default returns 300 expanded information.
    ];
    $res = $RongSDK->getMessage()->Expansion()->getList($message);
    Utils::dump("Get extension information", $res);
}
getList();
