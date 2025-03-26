<?php
/**
 * Message module history message instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Historical message retrieval
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'date'=> '2019011711',//Date
    ];
    $Chartromm = $RongSDK->getMessage()->History()->get($message);
    Utils::dump("Historical message retrieval",$Chartromm);
}
get();

/**
 * Historical message file deletion
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'date'=> '2018011116',//Date
    ];
    $Chartromm = $RongSDK->getMessage()->History()->remove($message);
    Utils::dump("Historical message file deletion",$Chartromm);
}
remove();

/**
 * Message clearance
 */
function clean()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'conversationType'=> '1',//Conversation types, supporting single chat, group chat, and system notifications. Single chat is 1, group chat is 3, and system notification is 6.
        'fromUserId'=>"fromUserId",//@param userID The user ID
//@param msgTimestamp The timestamp of the session message to delete historical messages before
        'targetId'=>"userId",//The target session ID that needs to be cleared
        'msgTimestamp'=>"1588838388320",//Clear all historical messages before the specified timestamp, accurate to the millisecond, to empty all historical messages of the session.
    ];
    $Chartromm = $RongSDK->getMessage()->History()->clean($message);
    Utils::dump("Message clearance",$Chartromm);
}
clean();
