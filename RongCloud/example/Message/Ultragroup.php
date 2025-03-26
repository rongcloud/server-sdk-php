<?php
/**
 * Message module super group message instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Super group message delivery
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['phpgroup1'],// Super group ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'php Group message, hello, Xiaoming'])// Message Body
    ];
    $Result = $RongSDK->getMessage()->Ultragroup()->send($message);
    Utils::dump("Super group message delivery",$Result);
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
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Supergroup ID
        "objectName"=>'RC:TxtMsg',// Message type: Text
        'content'=>json_encode([// Message content
            'content'=>'PHP Group @message, hello, Xiaoming',
            'mentionedInfo'=>[
                'type'=>'1',// @function type, 1 represents @all, 2 represents @specified user
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],// The @ list is mandatory when type is 2, and can be empty when type is 1
                'pushContent'=>'php push greeting message'// Custom @ Message Push Content
            ]
        ])
    ];
    $Result = $RongSDK->getMessage()->Ultragroup()->sendMention($message);
    Utils::dump("Send @ message",$Result);
}
sendMention();
/**
 * Supergroup message recall
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],// Group ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',// Message unique identifier
        'sentTime'=>'1519444243981'// Delivery Time
/* Delivery Time */
    ];
    $Chartromm = $RongSDK->getMessage()->Ultragroup()->recall($message);
    Utils::dump("Supergroup message recall",$Chartromm);
}
recall();
