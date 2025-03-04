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
        'content'=>json_encode(['content'=>'php 群消息 你好，小明'])// Message Body
    ];
    $Result = $RongSDK->getMessage()->Group()->send($message);
    Utils::dump("群组消息发送",$Result);
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
            'content'=>'PHP 群 @ 消息 你好，小明',
            'mentionedInfo'=>[
                'type'=>'1',// Function type, 1 indicates @ all users, 2 indicates @ specified user
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],// The @ list must be filled when the type is 2, and can be empty when the type is 1.
                'pushContent'=>'php push 问候消息'// Custom @ Message Push Content
            ]
        ])
    ];
    $Result = $RongSDK->getMessage()->Group()->sendMention($message);
    Utils::dump("发送 @ 消息",$Result);
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
        'content'=>json_encode(['content'=>'php 群状态消息 你好，小明'])// Message Body
    ];
    $Result = $RongSDK->getMessage()->Group()->sendStatusMessage($message);
    Utils::dump("群组状态消息发送",$Result);
}
sendStatusMessage();

/**
 * Recall a sent group chat message
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',// Sender ID
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Group ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',// The unique identifier of the message
        'sentTime'=>'1519444243981'// Message sending time
    ];
    $Result = $RongSDK->getMessage()->Group()->recall($message);
    Utils::dump("撤回已发送的群聊消息",$Result);
}
recall();
