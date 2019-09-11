<?php
/**
 * 消息模块 广播消息
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 广播消息撤回
 */
function recall()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $message = [
        'senderId'=> 'test',//发送人 id
        "objectName"=>'RC:RcCmd',//消息类型
        'content'=>json_encode([
            'uId'=>'xxxxx',//消息唯一标识，通过 /push 发送广播消息后获取，返回名称为 id。
            'isAdmin'=>'0',//是否为管理员，默认为 0；设为 1 时 IMKit SDK 收到此条消息后，小灰条默认显示为“管理员 撤加了一条消息”
            'isDelete'=>'0'//是否删除消息，默认为 0 撤回该条消息同时，用户端将该条消息删除并替换为一条小灰条撤回提示消息；为 1 时，该条消息删除后，不替换为小灰条提示消息。
        ])
    ];
    $Result = $RongSDK->getMessage()->Broadcast()->recall($message);
    Utils::dump("广播消息撤回",$Result);
}
recall();

