<?php
/**
 * 消息模块 超级群消息实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 超级群消息发送
 */
function send()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'targetId'=> ['phpgroup1'],//超级群 id
        "objectName"=>'RC:TxtMsg',//消息类型 文本
        'content'=>json_encode(['content'=>'php 群消息 你好，小明'])//消息体
    ];
    $Result = $RongSDK->getMessage()->Ultragroup()->send($message);
    Utils::dump("超级群消息发送",$Result);
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
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],//超级群 id
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
    $Result = $RongSDK->getMessage()->Ultragroup()->sendMention($message);
    Utils::dump("发送 @ 消息",$Result);
}
sendMention();
/**
 * 超级群消息撤回
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'Vu-oC0_LQ6kgPqltm_zYtI',//发送人 id
        'targetId'=> ['uPj70HUrRSUk-ixtt7iIGc'],//群id
        "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息唯一标识
        'sentTime'=>'1519444243981'//发送时间
    ];
    $Chartromm = $RongSDK->getMessage()->Ultragroup()->recall($message);
    Utils::dump("超级群消息撤回",$Chartromm);
}
recall();
