<?php
/**
 * Message module chat room message instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Send messages in the chat room
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'aP9uvganV',// Sender ID
        'targetId'=> ['OIBbeKlkx'],// Chat room ID
        "objectName"=>'RC:TxtMsg',// Message type: Text
        'content'=>json_encode(['content'=>'php chatroom 你好，主播'])// Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Chatroom()->send($message);
    Utils::dump("Send messages in the chat room",$Chartromm);
}
send();

/**
 * Chat room broadcast message
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'aP9uvganV',// Sender ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'php Chatroom Broadcast 你好，主播'])// Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Chatroom()->broadcast($message);
    Utils::dump("Chat room broadcast message",$Chartromm);
}
broadcast();

/**
 * Withdraw a sent chat room message
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',// Sender Id
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Chat room id
        "uId"=>'5GSB-RPM1-KP8H-9JHF',// The unique identifier of the message
        'sentTime'=>'1519444243981'// Message delivery time
    ];
    $Result = $RongSDK->getMessage()->Chatroom()->recall($message);
    Utils::dump("Withdraw a sent chat room message",$Result);
}
recall();

