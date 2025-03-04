<?php
/**
 * Message Module Two-Person Message Instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Two-person message sending
 */
function send()
{
    // Connect to Singapore Data Center
    // RongCloud::$apiUrl = ['http://api.sg-light-api.com/'];
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],// recipient id
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'你好，这是 1 条二人消息'])// Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->send($message);
    Utils::dump("二人消息发送",$Chartromm);
}
send();

/**
 * Send different content messages to multiple users
 */
function sendTemplate()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'objectName'=>'RC:TxtMsg',// Message type: Text
        'template'=>json_encode(['content'=>'{name}, 语文成绩 {score} 分']),// Template content
        'content'=>json_encode([
            'uPj70HUrRSUk-ixtt7iIGc'=>[// Recipient ID
                'data'=>['{name}'=>'小明','{score}'=>'90'],// Template Data
                'push'=>'{name} 你的成绩出来了',// Push content
            ],
            'Vu-oC0_LQ6kgPqltm_zYtI'=>[// Recipient ID
                'data'=>['{name}'=>'小红','{score}'=>'95'],// Template Data
                'push'=>'{name} 你的成绩出来了',// push notification content
            ]
        ])
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->sendTemplate($message);
    Utils::dump("向多个用户发送不同内容消息",$Chartromm);
}
sendTemplate();

/**
 * Two-person status message sending
 */
function sendStatusMessage()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],// Recipient ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode(['content'=>'你好，这是 1 条二人状态消息'])// Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->sendStatusMessage($message);
    Utils::dump("二人状态消息发送",$Chartromm);
}
sendStatusMessage();
/**
 * Two-person message recall
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',// Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],// Recipient ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',// Message unique identifier
        'sentTime'=>'1519444243981'// Send time
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->recall($message);
    Utils::dump("二人消息撤回",$Chartromm);
}
recall();
