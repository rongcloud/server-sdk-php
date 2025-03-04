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
        'content' => json_encode(['content' => 'Hello live streaming host']) // Message content
    ];
    Utils::dump("Chat room message sent successfully", $Message->send($params));

    Utils::dump("Chat room message sending parameter error", $Message->send());

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => 'RC:TxtMsg',
        'content' => json_encode(['content' => 'Hello live streaming host'])
    ];
    Utils::dump("Chat room message sending targetId error", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => '',
        'content' => json_encode(['content' => 'Hello live streaming host'])
    ];
    Utils::dump("Chatroom message sending objectName error", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => 'RC:TxtMsg',
        'content' => []
    ];
    Utils::dump("Chat room message sending content error", $Message->send($params));

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        "objectName" => 'RC:TxtMsg', // Message type: Text
        'content' => json_encode(['content' => 'Hello live streaming host'])// Message content
    ];
    Utils::dump("Chat room broadcast message successful", $Message->broadcast($params));

    Utils::dump("Chat room broadcast message parameter error", $Message->broadcast());


    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => '',
        'content' => json_encode(['content' => 'Hello live streaming host'])
    ];
    Utils::dump("Chat room broadcast message objectName error", $Message->broadcast($params));

    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => 'RC:TxtMsg',
        'content' => []
    ];
    Utils::dump("Chat room broadcast message content error", $Message->broadcast($params));

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Chat room Id
        "uId" => '5GSB-RPM1-KP8H-9JHF', // The unique identifier of the message
        'sentTime' => '1519444243981' // Message sending time
    ];
    Utils::dump("Successfully recalled the sent chat room message", $Message->recall($params));

    Utils::dump("Revoke sent chat room message parameter error", $Message->recall());

    $params = [
        'senderId' => 'ujadk90ha',
        "uId" => '5GSB-RPM1-KP8H-9JHF',
        'sentTime' => '1519444243981'
    ];
    Utils::dump("Revoke the sent chat room message with targetId error", $Message->recall($params));
}

testMessageChatroom($RongSDK);

function testMessageGroup($RongSDK)
{
    $Message = $RongSDK->getMessage()->Group();
    $params = [
        'senderId' => 'ujadk90ha', // sender id
        'targetId' => 'kkj9o01', // Chat room ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode(['content' => 'Hello live streaming host']) // Message content
    ];
    Utils::dump("Group message sent successfully", $Message->send($params));

    Utils::dump("Group message sending parameter error
@param error in group message sending parameters", $Message->send());

    Utils::dump("Group message sent successfully", $Message->sendStatusMessage($params));

    Utils::dump("Group send status message parameter error", $Message->sendStatusMessage());

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => 'RC:TxtMsg',
        'content' => json_encode(['content' => 'Hello live streaming host'])
    ];
    Utils::dump("Error in sending group message targetId", $Message->send($params));
    Utils::dump("Group sending status message targetId error", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => '',
        'content' => json_encode(['content' => 'Hello live streaming host'])
    ];
    Utils::dump("Group message sending error objectName", $Message->send($params));
    Utils::dump("Group sending status message objectName error", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => 'kkj9o01',
        "objectName" => 'RC:TxtMsg',
    ];
    Utils::dump("Group message sending error", $Message->send($params));
    Utils::dump("Group send status message content error", $Message->sendStatusMessage($params));

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Group ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode([ // Message content
            'content' => 'Hello Xiaoming',
            'mentionedInfo' => [
                'type' => '1', // @function type, 1 represents @all. 2 represents @specified user
                'userIds' => ['kladd', 'almmn1'], // The @ list must be filled when the type is 2, and can be empty when the type is 1
                'pushContent' => 'greeting message' // Custom @ Message push content
            ]
        ])
    ];
    Utils::dump("Message sent successfully", $Message->sendMention($params));

    Utils::dump("Send @ message parameter error", $Message->sendMention());


    $params = [
        'senderId' => 'ujadk90ha',
        'targetId' => '',
        "objectName" => '',
    ];
    Utils::dump("Failed to send message to targetId", $Message->sendMention($params));

    $params = [
        'senderId' => 'ujadk90ha',
        "objectName" => 'RC:TxtMsg',
        'targetId' => 'markoiwm',
    ];
    Utils::dump("Send @ message content error", $Message->sendMention($params));

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Group ID
        "uId" => '5GSB-RPM1-KP8H-9JHF', // The unique identifier of the message
        'sentTime' => '1519444243981' // Message sending time
    ];
    Utils::dump("Successfully revoked the sent group chat message", $Message->recall($params));

    Utils::dump("Withdraw the mistakenly sent group chat message parameter", $Message->recall());

    $params = [
        'senderId' => 'ujadk90ha',
        "uId" => '5GSB-RPM1-KP8H-9JHF',
        'sentTime' => '1519444243981'
    ];
    Utils::dump("Revoke the sent group chat message with an incorrect targetId", $Message->recall($params));
}

testMessageGroup($RongSDK);

function testMessageHistory($RongSDK)
{
    $Message = $RongSDK->getMessage()->History();
    $params = [
        'date' => '2018030613', // Date
    ];
    Utils::dump("Historical message retrieval successful", $Message->get($params));

    Utils::dump("Historical message retrieval parameter error", $Message->get());

    $params = [
        'date' => '2018030613', // Date
    ];
    Utils::dump("Historical message file deleted successfully", $Message->remove($params));

    Utils::dump("Historical message file deletion parameter error", $Message->remove());

     $params = [
            'conversationType'=> '1', //Conversation types, supporting single chat, group chat, and system notifications. Single chat is 1, group chat is 3, and system notification is 6.
            'fromUserId'=>"fromUserId", //User ID, delete historical messages before the specified session msgTimestamp
            'targetId'=>"userId", //Target session ID to be cleared
            'msgTimestamp'=>"1588838388320", //Clear all historical messages before this timestamp, accurate to the millisecond, to empty all historical messages of this session.
        ];
    Utils::dump("Message cleared successfully", $Message->clean($params));

    Utils::dump("Clear message parameter error", $Message->clean());
}

testMessageHistory($RongSDK);

function testMessagePerson($RongSDK)
{
    $Message = $RongSDK->getMessage()->Person();
    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Recipient ID
        "objectName" => 'RC:TxtMsg', // Message type: Text
        'content' => json_encode(['content' => 'Hello, this is a message.'])// Message content
    ];
    Utils::dump("Message sent successfully", $Message->send($params));

    Utils::dump("Error in sending two-person message parameters", $Message->send());

    Utils::dump("Two-person status message sent successfully", $Message->sendStatusMessage($params));

    Utils::dump("Error in sending two-person status message parameters", $Message->sendStatusMessage());

    $params = [
        'senderId' => 'kamdnq', // Sender ID
        'objectName' => 'RC:TxtMsg', // Message type Text
        'template' => json_encode(['content' => '{name}, Language score {score}']), // Template content
        'content' => json_encode([
            'sea9901' => [ // Recipient ID
                'data' => ['{name}' => 'Xiaoming', '{score}' => '90'], // Template data
                'push' => '{name} Your grades are in.', // Push content
            ],
            'sea9902' => [ // Recipient ID
                'data' => ['{name}' => 'Xiaohong', '{score}' => '95'], // Template data
                'push' => '{name} Your grades are in.', // push notification content
            ]
        ])
    ];
    Utils::dump("Successfully sent different content messages to multiple users", $Message->sendTemplate($params));

    Utils::dump("@param Error in sending different content messages to multiple users", $Message->sendTemplate());

    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => 'markoiwm', // Recipient ID
        "uId" => '5GSB-RPM1-KP8H-9JHF', // Message unique identifier The unique identifier of the message, each end SDK will return uId after successfully sending the message
        'sentTime' => '1519444243981' // Send time The time when the message is sent, each SDK will return sentTime after successfully sending the message
    ];
    Utils::dump("Two-person message recall successful", $Message->recall($params));

    Utils::dump("Two-person message recall parameter error", $Message->recall());
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
        'content' => ['content' => 'Hello Xiaoming'] // Message Body
    ];
    Utils::dump("System message successfully sent", $Message->send($params));

    Utils::dump("System message delivery parameter error
/* System message delivery parameter error */", $Message->send());

    $params = [
        'senderId' => '__system__', // Sender ID
        'objectName' => 'RC:TxtMsg', // Message type Text
        'template' => json_encode(['content' => '{name}, Language score {score}']),// Template content
        'content' => json_encode([
            'sea9901' => [//Recipient ID
                'data' => ['{name}' => 'Xiaoming', '{score}' => '90'], //Template Data
                'push' => '{name} Your grades are in.', // Push content
            ],
            'sea9902' => [// recipient id
                'data' => ['{name}' => 'Xiaohong', '{score}' => '95'],// Template data
                'push' => '{name} Your grades are in.', // push notification content
            ]
        ])
    ];
    Utils::dump("System template message succeeded", $Message->sendTemplate($params));

    Utils::dump("System template message parameter error", $Message->sendTemplate());

    $params = [
        'senderId' => '__system__', // Sender ID
        "objectName" => 'RC:TxtMsg', // Message type
        'content' => ['content' => 'Hello Xiaoming'] // Message content
    ];
    Utils::dump("System broadcast message successful", $Message->broadcast($params));

    Utils::dump("System broadcast message parameter error", $Message->broadcast());

    $params = [
        'userIds' => ["user1","user2"], // Recipient ID
        'notification' => [
            "pushContent">"push notification content",
            "title">"push notification title"
            ]
    ];
    Utils::dump("Notification of successful deployment", $Message->pushUser($params));
    Utils::dump("Notification parameter error", $Message->pushUser());
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
    Utils::dump("Broadcast message withdrawal successful", $Result);

    $message = [
        "objectName" => 'RC:RcCmd', // Message type
        'content' => json_encode([
            'uId' => 'xxxxx',
            'isAdmin' => '0',
            'isDelete' => '0'
        ])
    ];
    $Result = $Message->recall($message);
    Utils::dump("Broadcast message withdrawal parameter error", $Result);
}
testMessageBroadcast($RongSDK);

function textExpansionSet($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',    //Message unique identifier ID, which can be obtained by the server through the full message routing function.
        'userId'            => 'WNYZbMqpH',              //Set the extended message delivery user Id.
        'targetId'          => 'tjw3zbMrU',              //Target ID, depending on the conversationType, could be a user ID or a group ID.
        'conversationType'  => '1',                      //Conversation type, private chat is 1, group chat is 3, only supports private and group chat types.
        'extraKeyVal'       => ['type1' => '1', 'type2' => '2', 'type3' => '3', 'type4' => '4',] // Custom message extension content, JSON structure, set in Key, Value format
    ];
    $Result = $Expansion->set($message);
    Utils::dump("Set message extension", $Result);
}
textExpansionSet($RongSDK);

function textExpansionDelete($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID'            => 'BS45-NPH4-HV87-10LM',    //The unique message identifier, which the server can obtain through the full message routing function.
        'userId'            => 'WNYZbMqpH',              //The user ID for sending extended messages needs to be set.
        'targetId'          => 'tjw3zbMrU',              //Target ID, which could be a user ID or group ID depending on the conversationType.
        'conversationType'  => '1',                      //Conversation type, one-on-one chat is 1, group chat is 3, only supports single chat and group chat types.
        'extraKey'          => ['type1', 'type2']        //The Key value of the extension information to be deleted, with a maximum of 100 extension information items that can be deleted at once
    ];
    $Result = $Expansion->delete($message);
    Utils::dump("Delete message extension", $Result);
}
textExpansionDelete($RongSDK);

function textExpansionGetList($RongSDK)
{
    $Expansion = $RongSDK->getMessage()->Expansion();
    $message = [
        'msgUID' => 'BS45-NPH4-HV87-10LM',   //The unique identifier of the message, which can be obtained by the server through the full message routing function.
        'pageNo' => 1                      //Number of pages, default returns 300 extended information.
    ];
    $Result = $Expansion->getList($message);
    Utils::dump("Get extension information", $Result);
}
textExpansionGetList($RongSDK);

function textUltragroup($RongSDK)
{
    $Ultragroup = $RongSDK->getMessage()->Ultragroup();
    $params = [
        'senderId' => 'ujadk90ha', // Sender ID
        'targetId' => ['kkj9o01'], // Super group ID
        "objectName" => 'RC:TxtMsg', // Message type Text
        'content' => json_encode(['content' => 'Hello live streaming host']) // Message content
    ];
    Utils::dump("Super group message sent successfully", $Ultragroup->send($params));

    Utils::dump("Super group message sending parameter error", $Ultragroup->send());

    $params = [
        'senderId'=> 'ujadk90ha', //Sender ID
        'targetId'=> ['STRe0shISpQlSOBvek1FfU'], //Supergroup ID
        "objectName"=>'RC:TxtMsg', //Message type Text
        'content'=>json_encode([ //Message content
            'content'=>'PHP group @ messege Hello Xiaoming',
            'mentionedInfo'=>[
                'type'=>'1', //@ Function type, 1 indicates @ everyone. 2 indicates @ specified user.
                'userIds'=>['uPj70HUrRSUk-ixtt7iIGc'], //The @ list must be filled when type is 2, and can be empty when type is 1
                'pushContent'=>'php push greeting message' //Customize @ message push content
            ]
        ])
    ];
    Utils::dump("Super group message sent @ message successful", $Ultragroup->sendMention($params));

    Utils::dump("Super group send @ message parameter error", $Ultragroup->sendMention());
}
textUltragroup($RongSDK);



