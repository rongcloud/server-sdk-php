<?php

/**
 * Message module system message module
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * System message delivery
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'senderId' => '__system__',//  Sender ID
        'targetId' => 'uPj70HUrRSUk-ixtt7iIGc',//  Receive release id
        "objectName" => 'RC:TxtMsg',//  Message type Text
        'content' => ['content' => 'php system message']//  Message Body
    ];
    $Result = $RongSDK->getMessage()->System()->send($message);
    Utils::dump("System message delivery
/* @param system message delivery */", $Result);
}
send();

/**
 * System broadcast message
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'senderId' => '__system__',//  Sender ID
        "objectName" => 'RC:TxtMsg',//  Message type
        'content' => ['content' => 'php broadcast message']//  Message content
    ];
    $Result = $RongSDK->getMessage()->System()->broadcast($message);
    Utils::dump("System broadcast message", $Result);
}
broadcast();

/**
 * Broadcast to online users
 */
function onlineBroadcast()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'senderId' => '__system__',//  Sender ID
        "objectName" => 'RC:TxtMsg',//  Message type
        'content' => ['content' => 'php broadcast message']//  Message content
    ];
    $Result = $RongSDK->getMessage()->System()->onlineBroadcast($message);
    Utils::dump("Broadcast to online users", $Result);
}

onlineBroadcast();
/**
 * System template message
 */
function sendTemplate()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'senderId' => '__system__',//  Sender ID
        'objectName' => 'RC:TxtMsg',//  Message type Text
        'template' => json_encode(['content' => '{name}, Language score {score}']),//  Template content
        'content' => json_encode([
            'Vu-oC0_LQ6kgPqltm_zYtI' => [//  Recipient ID
                'data' => ['{name}' => 'Xiaoming', '{score}' => '90'],//  Template data
                'push' => '{name} php System Template Message',//  Push content
            ],
            'uPj70HUrRSUk-ixtt7iIGc' => [//  Recipient ID
                'data' => ['{name}' => '小红', '{score}' => '95'],//  Template data
                'push' => '{name} php 系统模板消息',//  push notification content
            ]
        ])
    ];
    $Chartromm = $RongSDK->getMessage()->System()->sendTemplate($message);
    Utils::dump("System template message", $Chartromm);
}
sendTemplate();

/**
 * Push-only Notification
 */
function pushUser()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $message = [
        'userIds' => ["user1","user2"],//  Recipient ID
        'notification' => [
            "pushContent"=>"push content",
            "title"=>"push title",
            "ios"=>
                [
                    "thread-id"=>"223",
                    "apns-collapse-id"=>"111",
                    "extras"=> ["id"=>"1","name"=>"2"]
                ],
            "android"=> [
                "hw"=>[
                    "channelId"=>"NotificationKanong",
                    "importance"=> "NORMAL",
                    "image"=>"https://example.com/image.png"
                ],
                "mi"=>[
                    "channelId"=>"rongcloud_kanong",
                    "large_icon_uri"=>"https=>//example.com/image.png"
                ],
                "oppo"=>[
                    "channelId"=>"rc_notification_id"
                ],
                "vivo"=>[
                    "classification"=>"0"
                ],
                "extras"=> ["id"=> "1","name"=> "2"]
            ]
        ]
    ];
    $Chartromm = $RongSDK->getMessage()->System()->pushUser($message);
    Utils::dump("Push-only Notification", $Chartromm);
}
pushUser();
