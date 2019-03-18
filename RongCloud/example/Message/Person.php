<?php
/**
 * 消息模块 二人消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 二人消息发送
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//接收人 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode(['content'=>'你好，主播'])//消息内容
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->send($message);
    Utils::dump("二人消息发送",$Chartromm);
}
send();

/**
 * 向多个用户发送不同内容消息
 */
function sendTemplate()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'objectName'=>'RC:TxtMsg',//消息类型 文本
        'template'=>json_encode(['content'=>'{name}, 语文成绩 {score} 分']),//模板内容
        'content'=>json_encode([
            'uPj70HUrRSUk-ixtt7iIGc'=>[//接收人 id
                'data'=>['{name}'=>'小明','{score}'=>'90'],//模板数据
                'push'=>'{name} 你的成绩出来了',//推送内容
            ],
            'Vu-oC0_LQ6kgPqltm_zYtI'=>[//接收人 id
                'data'=>['{name}'=>'小红','{score}'=>'95'],//模板数据
                'push'=>'{name} 你的成绩出来了',//推送内容
            ]
        ])
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->sendTemplate($message);
    Utils::dump("向多个用户发送不同内容消息",$Chartromm);
}
sendTemplate();

/**
 * 二人消息撤回
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//接收人 id
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息唯一标识
        'sentTime'=>'1519444243981'//发送时间
    ];
    $Chartromm = $RongSDK->getMessage()->Person()->recall($message);
    Utils::dump("二人消息撤回",$Chartromm);
}
recall();
