<?php
/**
 * 消息模块 聊天室消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 聊天室发送消息
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'aP9uvganV',//发送人 id
        'targetId'=> ['OIBbeKlkx'],//聊天室 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode(['content'=>'php 聊天室 你好，主播'])//消息内容
    ];
    $Chartromm = $RongSDK->getMessage()->Chatroom()->send($message);
    Utils::dump("聊天室发送消息",$Chartromm);
}
send();

/**
 * 聊天室广播消息
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'aP9uvganV',//发送人 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode(['content'=>'php 聊天室广播 你好，主播'])//消息内容
    ];
    $Chartromm = $RongSDK->getMessage()->Chatroom()->broadcast($message);
    Utils::dump("聊天室广播消息",$Chartromm);
}
broadcast();

/**
 * 撤回已发送的聊天室消息
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',//发送人 Id
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],//聊天室 id
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息的唯一标识
        'sentTime'=>'1519444243981'//消息的发送时间
    ];
    $Result = $RongSDK->getMessage()->Chatroom()->recall($message);
    Utils::dump("撤回已发送的聊天室消息",$Result);
}
recall();

