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
    //Connect to Singapore Data Center
    //RongCloud::$apiUrl = ['http://api.sg-light-api.com/'];
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//recipient id
        "objectName"=>'RC:TxtMsg',//Message type Text
        'content'=>json_encode(['content'=>'Hello, this is a two-person message'])//Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->send($message);
    Utils::dump("Two-person message sending",$Chartromm);
}
send();

/**
 * Send different content messages to multiple users
 */
function sendTemplate()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//Sender ID
        'objectName'=>'RC:TxtMsg',//Message type: Text
        'template'=>json_encode(['content'=>'{name}, Language score {score}']),// Template content
        'content'=>json_encode([
            'uPj70HUrRSUk-ixtt7iIGc'=>[//Recipient ID
                'data'=>['{name}'=>'Xiaoming','{score}'=>'90'],//Template Data
                'push'=>'{name} 你的成绩出来了',//Push content
            ],
            'Vu-oC0_LQ6kgPqltm_zYtI'=>[//Recipient ID
                'data'=>['{name}'=>'XiaoHong','{score}'=>'95'],// Template Data
                'push'=>'{name} Your grades are in.',//push notification content
            ]
        ])
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->sendTemplate($message);
    Utils::dump("Send different content messages to multiple users",$Chartromm);
}
sendTemplate();

/**
 * Two-person status message sending
 */
function sendStatusMessage()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//Recipient ID
        "objectName"=>'RC:TxtMsg',//Message type Text
        'content'=>json_encode(['content'=>'Hello, this is a two-person status message.'])//Message content
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->sendStatusMessage($message);
    Utils::dump("Two-person status message sending",$Chartromm);
}
sendStatusMessage();
/**
 * Two-person message recall
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//Sender ID
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//Recipient ID
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//Message unique identifier
        'sentTime'=>'1519444243981'//Send time
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->recall($message);
    Utils::dump("Two-person message recall",$Chartromm);
}
recall();

function getHistoryMsg()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'userId' => 'JmFV3UytI',
        'targetId' => 'AI32767626983b4d11b691bb86248dd8f3',
        'startTime' => time() * 1000,
        "endTime" => strtotime('-10 day') * 1000,
        'includeStart' => true
    ];
    $res = $RongSDK->getMessage()->Person()->getHistoryMsg($param);
    Utils::dump("getHistoryMsg", $res);
}
getHistoryMsg();
