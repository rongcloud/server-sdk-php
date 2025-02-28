<?php
/**
 * // Message module super group message instance
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
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// // Sender ID
        'targetId'=> ['phpgroup1'],// // Super group ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'php 群消息 你好，小明'])// // Message Body
    ];
    $Result = $RongSDK->getMessage()->Ultragroup()->send($message);
    Utils::dump("超级群消息发送",$Result);
}
send();

/**
 * Send @ message
 */
function sendMention()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',// // Sender ID
@sender_id
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Supergroup ID
        "objectName"=>'RC:TxtMsg',// Message type: Text
        'content'=>json_encode([// Message content
            'content'=>'PHP 群 @ 消息 你好，小明',
            'mentionedInfo'=>[
                'type'=>'1',// @function type, 1 represents @all, 2 represents @specified user
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],// // The @ list is mandatory when type is 2, and can be empty when type is 1
                'pushContent'=>'php push 问候消息'// Custom @ Message Push Content
            ]
        ])
    ];
    $Result = $RongSDK->getMessage()->Ultragroup()->sendMention($message);
    Utils::dump("发送 @ 消息",$Result);
}
sendMention();
/**
 * // Supergroup message recall
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// // Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],// // Group ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',// // Message unique identifier
        'sentTime'=>'1519444243981'// // Delivery Time
/* Delivery Time */
    ];
    $Chartromm = $RongSDK->getMessage()->Ultragroup()->recall($message);
    Utils::dump("超级群消息撤回",$Chartromm);
}
recall();
