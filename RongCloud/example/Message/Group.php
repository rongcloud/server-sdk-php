<?php
/**
 * 消息模块 群组消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 群组消息发送
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'targetId'=> ['php group1'],//群组 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode(['content'=>'php 群消息 你好，小明'])//消息体
    ];
    $Result = $RongSDK->getMessage()->Group()->send($message);
    Utils::dump("群组消息发送",$Result);
}
send();

/**
 * 发送 @ 消息
 */
function sendMention()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',//发送人 id
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],//群组 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode([//消息内容
            'content'=>'PHP 群 @ 消息 你好，小明',
            'mentionedInfo'=>[
                'type'=>'1',//@ 功能类型，1 表示 @ 所有人、2 表示 @ 指定用户
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],//被 @ 人列表 type 为 2 时必填，type 为 1 时可以为空
                'pushContent'=>'php push 问候消息'//自定义 @ 消息 push 内容
            ]
        ])
    ];
    $Result = $RongSDK->getMessage()->Group()->sendMention($message);
    Utils::dump("发送 @ 消息",$Result);
}
sendMention();

/**
 * 撤回已发送的群聊消息
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'ujadk90ha',//发送人 Id
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],//群组 id
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息的唯一标识
        'sentTime'=>'1519444243981'//消息的发送时间
    ];
    $Result = $RongSDK->getMessage()->Group()->recall($message);
    Utils::dump("撤回已发送的群聊消息",$Result);
}
recall();
