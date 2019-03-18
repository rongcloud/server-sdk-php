<?php
/**
 * 消息模块 系统消息模块
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 系统消息发送
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> '__system__',//发送人 id
        'targetId'=> 'uPj70HUrRSUk-ixtt7iIGc',//接收放 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>['content'=>'php 系统消息']//消息体
    ];
    $Result = $RongSDK->getMessage()->System()->send($message);
    Utils::dump("系统消息发送",$Result);
}
//send();

/**
 * 系统广播消息
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> '__system__',//发送人 id
        "objectName"=>'RC:TxtMsg',//消息类型
        'content'=>['content'=>'php 广播消息']//消息内容
    ];
    $Result = $RongSDK->getMessage()->System()->broadcast($message);
    Utils::dump("系统广播消息",$Result);
}
broadcast();
/**
 * 系统模板消息
 */
function sendTemplate()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> '__system__',//发送人 id
        'objectName'=>'RC:TxtMsg',//消息类型 文本
        'template'=>json_encode(['content'=>'{name}, 语文成绩 {score} 分']),//模板内容
        'content'=>json_encode([
            'Vu-oC0_LQ6kgPqltm_zYtI'=>[//接收人 id
                'data'=>['{name}'=>'小明','{score}'=>'90'],//模板数据
                'push'=>'{name} php 系统模板消息',//推送内容
            ],
            'uPj70HUrRSUk-ixtt7iIGc'=>[//接收人 id
                'data'=>['{name}'=>'小红','{score}'=>'95'],//模板数据
                'push'=>'{name} php 系统模板消息',//推送内容
            ]
        ])
    ];
    $Chartromm = $RongSDK->getMessage()->System()->sendTemplate($message);
    Utils::dump("系统模板消息",$Chartromm);
}
sendTemplate();
