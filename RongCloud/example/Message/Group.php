<?php
/**
 * Message module group message instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Group message sending
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['php group1'],// Group ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'PHP group message, hello, Xiaoming.'])// Message Body
    ];
    $Result = $RongSDK->getMessage()->Group()->send($message);
    Utils::dump("Group message sending",$Result);
}
send();

/**
 * Send @ message
 */
function sendMention()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',// Sender ID
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Group ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode([// Message content
            'content'=>'PHP group @message, hello, Xiaoming',
            'mentionedInfo'=>[
                'type'=>'1',// Function type, 1 indicates @ all users, 2 indicates @ specified user
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],// The @ list must be filled when the type is 2, and can be empty when the type is 1.
                'pushContent'=>'PHP push greeting message'// Custom @ Message Push Content
            ]
        ])
    ];
    $Result = $RongSDK->getMessage()->Group()->sendMention($message);
    Utils::dump("Send @ message",$Result);
}
sendMention();

/**
 * Group status message sending
 */
function sendStatusMessage()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['php group1'],// Group ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'PHP group status message, hello, Xiaoming.'])// Message Body
    ];
    $Result = $RongSDK->getMessage()->Group()->sendStatusMessage($message);
    Utils::dump("Group status message sending",$Result);
}
sendStatusMessage();

/**
 * Recall a sent group chat message
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',//Sender ID
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],//Group ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//The unique identifier of the message
        'sentTime'=>'1519444243981'//Message sending time
    ];
    $Result = $RongSDK->getMessage()->Group()->recall($message);
    Utils::dump("Recall a sent group chat message",$Result);
}
recall();
