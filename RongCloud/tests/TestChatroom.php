<?php
/**
 * Chat room module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

function testChatroom($RongSDK) {
    $Chatroom = $RongSDK->getChatroom();
    $params = [
        ['id' => 'chatroom9992',
         'name' => 'RongCloud']
    ];
    Utils::dump("Chat room created successfully", $Chatroom->create($params));

    Utils::dump("Create chat room parameter error", $Chatroom->create());

    $params = [
        'id' => 'watergroup1',
    ];
    Utils::dump("Chat room successfully destroyed", $Chatroom->destory($params));

    Utils::dump("Destroy chat room parameter error", $Chatroom->destory());

    $params = [
        'id' => 'chatroom9992',
        'count' => 10,
        'order' => 2
    ];
    Utils::dump("Successfully retrieved chat room information", $Chatroom->get($params));

    Utils::dump("Get chat room information parameter error", $Chatroom->get());

    $params = [
        'id' => 'chatroom9992',// Chat room id
        'members' => [
            ['id' => "sea9902"]// @param personnel ID
        ]
    ];
    Utils::dump("Check if the user has successfully joined the chat room", $Chatroom->isExist($params));

    Utils::dump("Check if the user has a parameter error in the chat room", $Chatroom->isExist());
}

testChatroom($RongSDK);

function testChatroomBan($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Ban();
    $params = [
        'members' => [
            ['id' => 'seal9901']// Personnel ID
        ],
        'minute' => 30// Forbidden duration
    ];
    Utils::dump("Add global chat room ban success", $Chatroom->add($params));

    Utils::dump("Add chat room global ban parameter error", $Chatroom->add());

    $params = [
        'members' => [
            ['id' => 'seal9901']// personnel id
        ],
    ];
    Utils::dump("Global chat room ban lifted successfully", $Chatroom->remove($params));

    Utils::dump("Unlock the global chat room mute error", $Chatroom->remove());

    $params = [

    ];
    Utils::dump("Get the global banned words list of the chat room successfully", $Chatroom->getList($params));

}

testChatroomBan($RongSDK);

function testChatroomBlock($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Block();
    $params = [
        'id' => 'watergroup1',// Group ID
        'members' => [//  Forbidden personnel list
                       ['id' => 'group9994']
        ],
        'minute' => 500  // Forbidden duration
    ];
    Utils::dump("Add block success", $Chatroom->add($params));

    Utils::dump("Add ban parameter error", $Chatroom->add());

    $params = [
        'id' => 'watergroup1',
        'members' => [
            ['id' => 'group9994']
        ],
        'minute' => 0
    ];
    Utils::dump("Add ban minute error", $Chatroom->add($params));

    $params = [
        'id' => 'watergroup1',// Group ID
        'members' => [//  Banned personnel list
                       ['id' => 'group9994']
        ]
    ];
    Utils::dump("Unblock successful", $Chatroom->remove($params));

    Utils::dump("Unblock parameter error", $Chatroom->remove());
    $params = [
        'id' => 'watergroup1',
        'members' => []
    ];
    Utils::dump("Unblock members error", $Chatroom->remove($params));

    $params = [
        'id' => 'watergroup1',// group id
    ];
    Utils::dump("Query the list of banned members successfully", $Chatroom->getList($params));

    Utils::dump("Query parameters error for the banned member list", $Chatroom->getList());
}

testChatroomBlock($RongSDK);

function testChatroomDemotion($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Demotion();
    $params = [
        'msgs' => ['RC:TxtMsg03', 'RC:TxtMsg02']// Message type list
    ];
    Utils::dump("Add application in-chat room downgrade message successfully", $Chatroom->add($params));

    Utils::dump("@param error in downgrading in-app chat room message parameters", $Chatroom->add());

    $params = [
        'msgs' => ['RC:TxtMsg03', 'RC:TxtMsg02']// Message type list
    ];
    Utils::dump("Successfully downgraded the in-app chat room", $Chatroom->remove($params));

    Utils::dump("Remove application internal chat room downgrade message parameter error", $Chatroom->remove());

    Utils::dump("Get the success message for downgrading the in-app chat room", $Chatroom->getList());
}

testChatroomDemotion($RongSDK);

function testChatroomDistribute($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Distribute();
    $params = [
        'id' => "Txtmsg03"// chatroom id
    ];
    Utils::dump("Stop chat room message distribution success", $Chatroom->stop($params));

    Utils::dump("Stop chat room message distribution parameter error", $Chatroom->stop());

    $params = [
        'id' => "Txtmsg03"// chatroom id
    ];
    Utils::dump("Restore chat room message distribution success", $Chatroom->resume($params));

    Utils::dump("Restore chat room message distribution parameter error", $Chatroom->resume());

}

testChatroomDistribute($RongSDK);

function testChatroomGag($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Gag();
    $params = [
        'id' => 'chatroom001',// Chat room id
        'members' => [
            ['id' => 'seal9901']// Forbidden personnel id
        ],
        'minute' => 30// Forbidden speech duration
    ];
    Utils::dump("Add chat room member ban success", $Chatroom->add($params));

    Utils::dump("Add chat room member ban parameter error", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chat room id
        'members' => [
            ['id' => 'seal9901']// Personnel ID
        ],
    ];
    Utils::dump("Successfully lifted the chat room member's ban", $Chatroom->remove($params));

    Utils::dump("Unban chat room member parameter error", $Chatroom->remove());

    $params = [
        'id' => 'ujadk90ha',// chatroom id
    ];
    Utils::dump("Get the list of banned words for chat room members successfully", $Chatroom->getList($params));

    Utils::dump("Get the chat room member ban list parameter error", $Chatroom->getList());

}

testChatroomGag($RongSDK);

function testChatroomMuteAllMembers($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->MuteAllMembers();
    $params = [
        'id' => 'chatroom001',//chatroom id
    ];
    Utils::dump("Add group chat room mute all success", $Chatroom->add($params));

    Utils::dump("Error in adding a global mute parameter for the chat room", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chatroom ID
    ];
    Utils::dump("Unmute all in the chat room successfully", $Chatroom->remove($params));

    Utils::dump("Clear the global mute parameter error of the chat room", $Chatroom->remove());

    Utils::dump("Check if the entire chat room is successfully muted", $Chatroom->check($params));

    Utils::dump("Check the success parameter for the global mute error in the chat room", $Chatroom->check());

    Utils::dump("Successfully obtained the complete mute list for the chat room", $Chatroom->getList(1,50));
}

testChatroomMuteAllMembers($RongSDK);

function testChatroomMuteWhiteList($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->MuteWhiteList();
    $params = [
        'id' => 'chatroom001',// Chat room ID
        "members"=>[
            ["id"=>"test1"]
        ]
    ];
    Utils::dump("Successfully added to the chat room's global mute whitelist", $Chatroom->add($params));

    Utils::dump("Add chat room global ban whitelist parameter error", $Chatroom->add());

    Utils::dump("Remove the entire mute whitelist of the chat room successfully", $Chatroom->remove($params));

    Utils::dump("Remove the chat room's global ban whitelist parameter error", $Chatroom->remove());


    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("Successfully obtained the complete whitelist of chat room bans", $Chatroom->getList($params));
}

testChatroomMuteWhiteList($RongSDK);

function testChatroomKeepalive($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Keepalive();
    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("Successfully added the chat room with livestream protection", $Chatroom->add($params));

    Utils::dump("Add error for survival chat room parameters", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chatroom ID
/* Chatroom ID */
    ];
    Utils::dump("Delete chat room successfully", $Chatroom->remove($params));

    Utils::dump("Delete the error in the parameter of the active chat room", $Chatroom->remove());

    Utils::dump("Get the list of chat rooms successfully", $Chatroom->getList());
}

testChatroomKeepalive($RongSDK);

function testChatroomWhitelistUser($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->User();
    $params = [
        "id" => "seal9901",// Chat room ID
        "members" => [
            ["id" => "user1"],//  User ID
            ["id" => "user2"]
        ]
    ];
    Utils::dump("Add chat room user whitelist successfully", $Chatroom->add($params));

    Utils::dump("Add chat room user whitelist parameter error", $Chatroom->add());

    $params = [
        "id" => "seal9901",// Chat room ID
        "members" => [
            ["id" => "user1"],//  User ID
            ["id" => "user2"]
        ]
    ];
    Utils::dump("Remove chat room user whitelist successfully", $Chatroom->remove($params));

    Utils::dump("Remove chat room user whitelist parameter error", $Chatroom->remove());

    $params = [
        "id" => "seal9901",// chatroom id
    ];
    Utils::dump("Get the chat room user whitelist successfully", $Chatroom->getList($params));

    Utils::dump("Get chat room user whitelist parameter error", $Chatroom->getList());
}

testChatroomWhitelistUser($RongSDK);

function testChatroomWhitelistMessage($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->Message();
    $params = [
        'msgs' => ["RC:TxtMsg"]// Message Type List
    ];
    Utils::dump("Add chat room message whitelist successfully", $Chatroom->add($params));

    Utils::dump("Add chat room message whitelist parameter error", $Chatroom->add());

    Utils::dump("Get the whitelist of chat room messages successfully", $Chatroom->getList());

    $params = [
        'msgs' => ["RC:TxtMsg"]// Message type list
    ];
    Utils::dump("Successfully removed chat room message whitelist", $Chatroom->remove($params));

    Utils::dump("Remove chat room message whitelist parameter error", $Chatroom->remove());

}

testChatroomWhitelistMessage($RongSDK);

function testChatroomEntry($RongSDK) {
    $Chatroom = $RongSDK->getChatroom();
    $params = [
        ['id' => 'chatroom001',
         'name' => 'RongCloud']
    ];
    $Chatroom->create($params);

    $Chatroom = $RongSDK->getChatroom()->Entry();
    $params = [
        'id' => 'chatroom001',// Chat room ID
        'userId' => 'userId01',// Operation User Id
        'key' => 'key001',// Chat room attribute name
        'value' => 'value001',// The value corresponding to the chat room attribute
    ];
    Utils::dump("Set chat room property successfully", $Chatroom->set($params));
    $params['key'] = 'key002';
    $params['value'] = ['value002'];
    $Chatroom->set($params);
    $params['key'] = 'key003';
    $params['value'] = ['value003'];
    $Chatroom->set($params);
    $params['key'] = 'key004';
    $params['value'] = ['value004'];
    $Chatroom->set($params);
    $params = [
        'id' => 'chatroom001',// Chat room ID
        'userId' => 'userId01',// Operation User Id
        'key' => 'key005',// Chat room attribute name
        'value' => 'value005',// Chat room attribute corresponding value
        'autoDelete' => true,// Whether to delete this Key value after the user exits the chat room
        'objectName' => 'RC:chrmKVNotiMsg',// Notification content
        'content' => '{"type":1,"key":"name","value":"live streaming host","extra":""}',// Chat room attribute corresponding value
    ];
    Utils::dump("Set chat room properties successfully (all parameters)", $Chatroom->set($params));

    Utils::dump("Set chat room property parameter error
@param error", $Chatroom->set());

    $params = [
        'id' => 'chatroom001',// Chat room ID
        'userId' => 'userId01',// Operation user ID
        'key' => 'key001',// Chat room attribute name
    ];
    Utils::dump("Delete chat room attribute success", $Chatroom->remove($params));

    Utils::dump("Delete chat room attribute parameter error", $Chatroom->remove());

    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("Get chat room properties (all)", $Chatroom->query($params));
    $params = [
        'id' => 'chatroom001',// Chat room ID
        'keys' => [
            ['key' => 'key004'],
            ['key' => 'key005']
        ]
    ];
    Utils::dump("Get chatroom properties (partial)", $Chatroom->query($params));
}

testChatroomEntry($RongSDK);