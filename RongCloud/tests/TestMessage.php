<?php

/**
 * 消息模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

function testMessageChatroom($RongSDK)
{
    $Message = $RongSDK->getMessage()->Chatroom();
    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => 'kkj9o01', //聊天室 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode(['content' => '你好，主播']) //消息内容
    ];
    Utils::dump("聊天室发送消息成功", $Message->send($params));

    Utils::dump("聊天室发送消息参数错误", $Message->send());

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => 'RC:TxtMsg',
        'content' => json_encode(['content' => '你好，主播'])
    ];
    Utils::dump("聊天室发送消息 targetId 错误", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => '',
        'content' => json_encode(['content' => '你好，主播'])
    ];
    Utils::dump("聊天室发送消息 objectName 错误", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => 'RC:TxtMsg',
        'content' => []
    ];
    Utils::dump("聊天室发送消息 content 错误", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode(['content' => '你好，主播']) //消息内容
    ];
    Utils::dump("聊天室广播消息成功", $Message->broadcast($params));

    Utils::dump("聊天室广播消息参数错误", $Message->broadcast());


    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => '',
        'content' => json_encode(['content' => '你好，主播'])
    ];
    Utils::dump("聊天室广播消息 objectName 错误", $Message->broadcast($params));

    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => 'RC:TxtMsg',
        'content' => []
    ];
    Utils::dump("聊天室广播消息 content 错误", $Message->broadcast($params));

    $params = [
        'senderId' => 'ujadk90ha', //发送人 Id
        'targetId' => 'markoiwm', //聊天室 Id
        "uId" => '5GSB-RPM1-KP8H-9JHF', //消息的唯一标识
        'sentTime' => '1519444243981' //消息的发送时间
    ];
    Utils::dump("撤回已发送的聊天室消息成功", $Message->recall($params));

    Utils::dump("撤回已发送的聊天室消息参数错误", $Message->recall());

    $params = [
        'senderId' => 'ujadk90ha',
        "uId" => '5GSB-RPM1-KP8H-9JHF',
        'sentTime' => '1519444243981'
    ];
    Utils::dump("撤回已发送的聊天室消息 targetId 错误", $Message->recall($params));
}

testMessageChatroom($RongSDK);

function testMessageGroup($RongSDK)
{
    $Message = $RongSDK->getMessage()->Group();
    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => 'kkj9o01', //聊天室 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode(['content' => '你好，主播']) //消息内容
    ];
    Utils::dump("群组发送消息成功", $Message->send($params));

    Utils::dump("群组发送消息参数错误", $Message->send());

    Utils::dump("群组发送状态消息成功", $Message->sendStatusMessage($params));

    Utils::dump("群组发送状态消息参数错误", $Message->sendStatusMessage());

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => 'RC:TxtMsg',
        'content' => json_encode(['content' => '你好，主播'])
    ];
    Utils::dump("群组发送消息 targetId 错误", $Message->send($params));
    Utils::dump("群组发送状态消息 targetId 错误", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => '',
        'content' => json_encode(['content' => '你好，主播'])
    ];
    Utils::dump("群组发送消息 objectName 错误", $Message->send($params));
    Utils::dump("群组发送状态消息 objectName 错误", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => 'RC:TxtMsg',
    ];
    Utils::dump("群组发送消息 content 错误", $Message->send($params));
    Utils::dump("群组发送状态消息 content 错误", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => 'markoiwm', //群组 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode([ //消息内容
            'content' => '你好，小明',
            'mentionedInfo' => [
                'type' => '1', //@ 功能类型，1 表示 @ 所有人、2 表示 @ 指定用户
                'userIds' => ['kladd', 'almmn1'], //被 @ 人列表 type 为 2 时必填，type 为 1 时可以为空
                'pushContent' => '问候消息' //自定义 @ 消息 push 内容
            ]
        ])
    ];
    Utils::dump("发送 @ 消息成功", $Message->sendMention($params));

    Utils::dump("发送 @ 消息参数错误", $Message->sendMention());


    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => '',
    ];
    Utils::dump("发送 @ 消息 targetId 错误", $Message->sendMention($params));

    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => 'RC:TxtMsg',
        'targetId' => 'markoiwm',
    ];
    Utils::dump("发送 @ 消息 content 错误", $Message->sendMention($params));

    $params = [
        'senderId' => 'ujadk90ha', //发送人 Id
        'targetId' => 'markoiwm', //群组 Id
        "uId" => '5GSB-RPM1-KP8H-9JHF', //消息的唯一标识
        'sentTime' => '1519444243981' //消息的发送时间
    ];
    Utils::dump("撤回已发送的群聊消息成功", $Message->recall($params));

    Utils::dump("撤回已发送的群聊消息参数错误", $Message->recall());

    $params = [
        'senderId' => 'ujadk90ha',
        "uId" => '5GSB-RPM1-KP8H-9JHF',
        'sentTime' => '1519444243981'
    ];
    Utils::dump("撤回已发送的群聊消息 targetId 错误", $Message->recall($params));
}

testMessageGroup($RongSDK);

function testMessageHistory($RongSDK)
{
    $Message = $RongSDK->getMessage()->History();
    $params = [
        'date' => '2018030613', //日期
    ];
    Utils::dump("历史消息获取成功", $Message->get($params));

    Utils::dump("历史消息获取参数错误", $Message->get());

    $params = [
        'date' => '2018030613', //日期
    ];
    Utils::dump("历史消息文件删除成功", $Message->remove($params));

    Utils::dump("历史消息文件删除参数错误", $Message->remove());

     $params = [
            'conversationType'=> '1',//会话类型，支持单聊、群聊、系统会话。单聊会话是 1、群组会话是 3、系统通知是 6
            'fromUserId'=>"fromUserId",//用户 ID，删除该用户指定会话 msgTimestamp 前的历史消息
            'targetId'=>"userId",//需要清除的目标会话 ID
            'msgTimestamp'=>"1588838388320",//清除该时间戳之前的所有历史消息，精确到毫秒，为空时清除该会话的所有历史消息。
        ];
    Utils::dump("消息清除成功", $Message->clean($params));

    Utils::dump("消息清除参数错误", $Message->clean());
}

testMessageHistory($RongSDK);

function testMessagePerson($RongSDK)
{
    $Message = $RongSDK->getMessage()->Person();
    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => 'markoiwm', //接收人 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode(['content' => '你好，这是 1 条消息']) //消息内容
    ];
    Utils::dump("二人消息发送成功", $Message->send($params));

    Utils::dump("二人消息发送参数错误", $Message->send());

    Utils::dump("二人状态消息发送成功", $Message->sendStatusMessage($params));

    Utils::dump("二人状态消息发送参数错误", $Message->sendStatusMessage());

    $params = [
        'senderId' => 'kamdnq', //发送人 id
        'objectName' => 'RC:TxtMsg', //消息类型 文本
        'template' => json_encode(['content' => '{name}, 语文成绩 {score} 分']), //模板内容
        'content' => json_encode([
            'sea9901' => [ //接收人 id
                'data' => ['{name}' => '小明', '{score}' => '90'], //模板数据
                'push' => '{name} 你的成绩出来了', //推送内容
            ],
            'sea9902' => [ //接收人 id
                'data' => ['{name}' => '小红', '{score}' => '95'], //模板数据
                'push' => '{name} 你的成绩出来了', //推送内容
            ]
        ])
    ];
    Utils::dump("向多个用户发送不同内容消息成功", $Message->sendTemplate($params));

    Utils::dump("向多个用户发送不同内容消息参数错误", $Message->sendTemplate());

    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => 'markoiwm', //接收人 id
        "uId" => '5GSB-RPM1-KP8H-9JHF', //消息唯一标识 消息的唯一标识，各端 SDK 发送消息成功后会返回 uId
        'sentTime' => '1519444243981' //发送时间 消息的发送时间，各端 SDK 发送消息成功后会返回 sentTime
    ];
    Utils::dump("二人消息撤回成功", $Message->recall($params));

    Utils::dump("二人消息撤回参数错误", $Message->recall());
}

testMessagePerson($RongSDK);

function testMessageSystem($RongSDK)
{
    $Message = $RongSDK->getMessage()->System();
    $params = [
        'senderId' => '__system__', //发送人 id
        'targetId' => 'markoiwm', //接收放 id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => ['content' => '你好，小明'] //消息体
    ];
    Utils::dump("系统消息发送成功", $Message->send($params));

    Utils::dump("系统消息发送参数错误", $Message->send());

    $params = [
        'senderId' => '__system__', //发送人 id
        'objectName' => 'RC:TxtMsg', //消息类型 文本
        'template' => json_encode(['content' => '{name}, 语文成绩 {score} 分']), //模板内容
        'content' => json_encode([
            'sea9901' => [ //接收人 id
                'data' => ['{name}' => '小明', '{score}' => '90'], //模板数据
                'push' => '{name} 你的成绩出来了', //推送内容
            ],
            'sea9902' => [ //接收人 id
                'data' => ['{name}' => '小红', '{score}' => '95'], //模板数据
                'push' => '{name} 你的成绩出来了', //推送内容
            ]
        ])
    ];
    Utils::dump("系统模板消息成功", $Message->sendTemplate($params));

    Utils::dump("系统模板消息参数错误", $Message->sendTemplate());

    $params = [
        'senderId' => '__system__', //发送人 id
        "objectName" => 'RC:TxtMsg', //消息类型
        'content' => ['content' => '你好，小明'] //消息内容
    ];
    Utils::dump("系统广播消息成功", $Message->broadcast($params));

    Utils::dump("系统广播消息参数错误", $Message->broadcast());

    $params = [
        'userIds' => ["user1","user2"], //接收人 id
        'notification' => [
            "pushContent">"推送内容",
            "title">"推送标题"
            ]
    ];
    Utils::dump("不落地通知成功", $Message->pushUser($params));
    Utils::dump("不落地通知参数错误", $Message->pushUser());
}

testMessageSystem($RongSDK);

function testMessageBroadcast($RongSDK)
{

    $Message = $RongSDK->getMessage()->Broadcast();
    $message = [
        'senderId' => 'test', //发送人 id
        "objectName" => 'RC:RcCmd', //消息类型
        'content' => json_encode([
            'uId' => 'xxxxx', //消息唯一标识，通过 /push 发送广播消息后获取，返回名称为 id。
            'isAdmin' => '0', //是否为管理员，默认为 0；设为 1 时 IMKit SDK 收到此条消息后，小灰条默认显示为“管理员 撤加了一条消息”
            'isDelete' => '0' //是否删除消息，默认为 0 撤回该条消息同时，用户端将该条消息删除并替换为一条小灰条撤回提示消息；为 1 时，该条消息删除后，不替换为小灰条提示消息。
        ])
    ];
    $Result = $Message->recall($message);
    Utils::dump("广播消息撤回成功", $Result);

    $message = [
        "objectName" => 'RC:RcCmd', //消息类型
        'content' => json_encode([
            'uId' => 'xxxxx',
            'isAdmin' => '0',
            'isDelete' => '0'
        ])
    ];
    $Result = $Message->recall($message);
    Utils::dump("广播消息撤回参数错误", $Result);
}
testMessageBroadcast($RongSDK);

function textExpansionSet($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'targetId'          => 'tjw3zbMrU',             //目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
        'conversationType'  => '1',                     //会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] //消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置
    ];
    $Result = $Expansion->set($message);
    Utils::dump("设置消息扩展", $Result);
}
textExpansionSet($RongSDK);

function textExpansionDelete($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
        'targetId'          => 'tjw3zbMrU',             //目标 Id，根据不同的 conversationType，可能是用户 Id 或群组 Id。
        'conversationType'  => '1',                     //会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
        'extraKey'          => ['type1', 'type2']       //需要删除的扩展信息的 Key 值，一次最多可以删除 100 个扩展信息
    ];
    $Result = $Expansion->delete($message);
    Utils::dump("删除消息扩展", $Result);
}
textExpansionDelete($RongSDK);

function textExpansionGetList($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
        'pageNo' => 1                     //页数，默认返回 300 个扩展信息。
    ];
    $Result = $Expansion->getList($message);
    Utils::dump("获取扩展信息", $Result);
}
textExpansionGetList($RongSDK);

function textUltragroup($RongSDK)
{
    $Ultragroup = $RongSDK->getMessage()->Ultragroup();
    $params = [
        'senderId' => 'ujadk90ha', //发送人 id
        'targetId' => ['kkj9o01'], //超级群id
        "objectName" => 'RC:TxtMsg', //消息类型 文本
        'content' => json_encode(['content' => '你好，主播']) //消息内容
    ];
    Utils::dump("超级群发送消息成功", $Ultragroup->send($params));

    Utils::dump("超级群发送消息参数错误", $Ultragroup->send());

    $params = [
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
    Utils::dump("超级群发送 @ 消息成功", $Ultragroup->sendMention($params));

    Utils::dump("超级群发送 @ 消息参数错误", $Ultragroup->sendMention());
}
textUltragroup($RongSDK);



