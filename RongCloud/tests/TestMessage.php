<?php

/**
 * Message module test case
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
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'kkj9o01', // Chat room ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode(['content' => '你好，主播']) // Message content
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
        'senderId' => 'ujadk90ha', // Sender ID
        "objectName" => 'RC:TxtMsg', // Message type: Text
        'content' => json_encode(['content' => '你好，主播']) // Message content
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
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Chat room Id
        "uId" => '5GSB-RPM1-KP8H-9JHF', // The unique identifier of the message
        'sentTime' => '1519444243981' // Message sending time
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
        'senderId' => 'ujadk90ha', // sender id
        'targetId' => 'kkj9o01', // Chat room ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode(['content' => '你好，主播']) // Message content
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
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Group ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode([ // Message content
            'content' => '你好，小明',
            'mentionedInfo' => [
                'type' => '1', // @function type, 1 represents @all. 2 represents @specified user
                'userIds' => ['kladd', 'almmn1'], // The @ list must be filled when the type is 2, and can be empty when the type is 1
                'pushContent' => '问候消息' // Custom @ Message push content
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
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Group ID
        "uId" => '5GSB-RPM1-KP8H-9JHF', // The unique identifier of the message
        'sentTime' => '1519444243981' // Message sending time
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
        'date' => '2018030613', // Date
    ];
    Utils::dump("历史消息获取成功", $Message->get($params));

    Utils::dump("历史消息获取参数错误", $Message->get());

    $params = [
        'date' => '2018030613', // Date
    ];
    Utils::dump("历史消息文件删除成功", $Message->remove($params));

    Utils::dump("历史消息文件删除参数错误", $Message->remove());

     $params = [
            'conversationType'=> '1',// Conversation types, supporting single chat, group chat, and system notifications. Single chat is 1, group chat is 3, and system notification is 6.
            'fromUserId'=>"fromUserId",// User ID, delete historical messages before the specified session msgTimestamp
            'targetId'=>"userId",// Target session ID to be cleared
            'msgTimestamp'=>"1588838388320",// Clear all historical messages before this timestamp, accurate to the millisecond, to empty all historical messages of this session.
        ];
    Utils::dump("消息清除成功", $Message->clean($params));

    Utils::dump("消息清除参数错误", $Message->clean());
}

testMessageHistory($RongSDK);

function testMessagePerson($RongSDK)
{
    $Message = $RongSDK->getMessage()->Person();
    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Recipient ID
        "objectName" => 'RC:TxtMsg', // Message type: Text
        'content' => json_encode(['content' => '你好，这是 1 条消息']) // Message content
    ];
    Utils::dump("二人消息发送成功", $Message->send($params));

    Utils::dump("二人消息发送参数错误", $Message->send());

    Utils::dump("二人状态消息发送成功", $Message->sendStatusMessage($params));

    Utils::dump("二人状态消息发送参数错误", $Message->sendStatusMessage());

    $params = [
        'senderId' => 'kamdnq', // Sender ID
        'objectName' => 'RC:TxtMsg', // Message type Text
        'template' => json_encode(['content' => '{name}, 语文成绩 {score} 分']), // Template content
        'content' => json_encode([
            'sea9901' => [ // Recipient ID
                'data' => ['{name}' => '小明', '{score}' => '90'], // Template data
                'push' => '{name} 你的成绩出来了', // Push content
            ],
            'sea9902' => [ // Recipient ID
                'data' => ['{name}' => '小红', '{score}' => '95'], // Template data
                'push' => '{name} 你的成绩出来了', // push notification content
            ]
        ])
    ];
    Utils::dump("向多个用户发送不同内容消息成功", $Message->sendTemplate($params));

    Utils::dump("向多个用户发送不同内容消息参数错误", $Message->sendTemplate());

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Recipient ID
        "uId" => '5GSB-RPM1-KP8H-9JHF', // Message unique identifier The unique identifier of the message, each end SDK will return uId after successfully sending the message
        'sentTime' => '1519444243981' // Send time The time when the message is sent, each SDK will return sentTime after successfully sending the message
    ];
    Utils::dump("二人消息撤回成功", $Message->recall($params));

    Utils::dump("二人消息撤回参数错误", $Message->recall());
}

testMessagePerson($RongSDK);

function testMessageSystem($RongSDK)
{
    $Message = $RongSDK->getMessage()->System();
    $params = [
        'senderId' => '__system__', // Sender ID
/* Sender ID */
        'targetId' => 'markoiwm', // Receive release id
        "objectName" => 'RC:TxtMsg', // Message type: Text
        'content' => ['content' => '你好，小明'] // Message Body
    ];
    Utils::dump("系统消息发送成功", $Message->send($params));

    Utils::dump("系统消息发送参数错误", $Message->send());

    $params = [
        'senderId' => '__system__', // Sender ID
        'objectName' => 'RC:TxtMsg', // Message type Text
        'template' => json_encode(['content' => '{name}, 语文成绩 {score} 分']), // Template content
        'content' => json_encode([
            'sea9901' => [ // Recipient ID
                'data' => ['{name}' => '小明', '{score}' => '90'], // Template Data
                'push' => '{name} 你的成绩出来了', // Push content
            ],
            'sea9902' => [ // recipient id
                'data' => ['{name}' => '小红', '{score}' => '95'], // Template data
                'push' => '{name} 你的成绩出来了', // push notification content
            ]
        ])
    ];
    Utils::dump("系统模板消息成功", $Message->sendTemplate($params));

    Utils::dump("系统模板消息参数错误", $Message->sendTemplate());

    $params = [
        'senderId' => '__system__', // Sender ID
        "objectName" => 'RC:TxtMsg', // Message type
        'content' => ['content' => '你好，小明'] // Message content
    ];
    Utils::dump("系统广播消息成功", $Message->broadcast($params));

    Utils::dump("系统广播消息参数错误", $Message->broadcast());

    $params = [
        'userIds' => ["user1","user2"], // Recipient ID
        'notification' => [
            "pushContent">"push notification content",
            "title">"push notification title"
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
        'senderId' => 'test', // Sender ID
        "objectName" => 'RC:RcCmd', // Message type
        'content' => json_encode([
            'uId' => 'xxxxx', // The unique identifier of the message, obtained after broadcasting the message via /push, the returned name is id.
            'isAdmin' => '0', // Whether it is an administrator, default is 0; when set to 1, the IMKit SDK will display the gray bar as "Administrator has withdrawn a message" after receiving this message.
            'isDelete' => '0' // Whether to delete the message, default is 0 to revoke the message while the client deletes and replaces it with a small gray bar revocation prompt message; when it is 1, after deleting the message, it will not be replaced with a small gray bar prompt message.
        ])
    ];
    $Result = $Message->recall($message);
    Utils::dump("广播消息撤回成功", $Result);

    $message = [
        "objectName" => 'RC:RcCmd', // Message type
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
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // Message unique identifier ID, which can be obtained by the server through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // Set the extended message delivery user Id.
        'targetId'          => 'tjw3zbMrU',             // Target ID, depending on the conversationType, could be a user ID or a group ID.
        'conversationType'  => '1',                     // Conversation type, private chat is 1, group chat is 3, only supports private and group chat types.
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] // Custom message extension content, JSON structure, set in Key, Value format
    ];
    $Result = $Expansion->set($message);
    Utils::dump("设置消息扩展", $Result);
}
textExpansionSet($RongSDK);

function textExpansionDelete($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',   // The unique message identifier, which the server can obtain through the full message routing function.
        'userId'            => 'WNYZbMqpH',             // The user ID for sending extended messages needs to be set.
        'targetId'          => 'tjw3zbMrU',             // Target ID, which could be a user ID or group ID depending on the conversationType.
        'conversationType'  => '1',                     // Conversation type, one-on-one chat is 1, group chat is 3, only supports single chat and group chat types.
        'extraKey'          => ['type1', 'type2']       // The Key value of the extension information to be deleted, with a maximum of 100 extension information items that can be deleted at once
    ];
    $Result = $Expansion->delete($message);
    Utils::dump("删除消息扩展", $Result);
}
textExpansionDelete($RongSDK);

function textExpansionGetList($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',  // The unique identifier of the message, which can be obtained by the server through the full message routing function.
        'pageNo' => 1                     // Number of pages, default returns 300 extended information.
    ];
    $Result = $Expansion->getList($message);
    Utils::dump("获取扩展信息", $Result);
}
textExpansionGetList($RongSDK);

function textUltragroup($RongSDK)
{
    $Ultragroup = $RongSDK->getMessage()->Ultragroup();
    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => ['kkj9o01'], // Super group ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode(['content' => '你好，主播']) // Message content
    ];
    Utils::dump("超级群发送消息成功", $Ultragroup->send($params));

    Utils::dump("超级群发送消息参数错误", $Ultragroup->send());

    $params = [
        'senderId'=> 'ujadk90ha',// Sender ID
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'],// Supergroup ID
        "objectName"=>'RC:TxtMsg',// Message type Text
        'content'=>json_encode([// Message content
            'content'=>'PHP 群 @ 消息 你好，小明',
            'mentionedInfo'=>[
                'type'=>'1',// @ Function type, 1 indicates @ everyone. 2 indicates @ specified user.
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'],// The @ list must be filled when type is 2, and can be empty when type is 1
                'pushContent'=>'php push 问候消息'// Customize @ message push content
            ]
        ])
    ];
    Utils::dump("超级群发送 @ 消息成功", $Ultragroup->sendMention($params));

    Utils::dump("超级群发送 @ 消息参数错误", $Ultragroup->sendMention());
}
textUltragroup($RongSDK);



