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
    Utils::dump("创建聊天室成功", $Chatroom->create($params));

    Utils::dump("创建聊天室参数错误", $Chatroom->create());

    $params = [
        'id' => 'watergroup1',
    ];
    Utils::dump("销毁聊天室成功", $Chatroom->destory($params));

    Utils::dump("销毁聊天室参数错误", $Chatroom->destory());

    $params = [
        'id' => 'chatroom9992',
        'count' => 10,
        'order' => 2
    ];
    Utils::dump("获取聊天室信息成功", $Chatroom->get($params));

    Utils::dump("获取聊天室信息参数错误", $Chatroom->get());

    $params = [
        'id' => 'chatroom9992',// Chat room id
        'members' => [
            ['id' => "sea9902"]// @param personnel ID
        ]
    ];
    Utils::dump("检查用户是否在聊天室成功", $Chatroom->isExist($params));

    Utils::dump("检查用户是否在聊天室参数错误", $Chatroom->isExist());
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
    Utils::dump("添加聊天室全局禁言成功", $Chatroom->add($params));

    Utils::dump("添加聊天室全局禁言参数错误", $Chatroom->add());

    $params = [
        'members' => [
            ['id' => 'seal9901']// personnel id
        ],
    ];
    Utils::dump("解除聊天室全局禁言成功", $Chatroom->remove($params));

    Utils::dump("解除聊天室全局禁言错误", $Chatroom->remove());

    $params = [

    ];
    Utils::dump("获取聊天室全局禁言列表成功", $Chatroom->getList($params));

}

testChatroomBan($RongSDK);

function testChatroomBlock($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Block();
    $params = [
        'id' => 'watergroup1',// Group ID
        'members' => [ // Forbidden personnel list
                       ['id' => 'group9994']
        ],
        'minute' => 500  // Forbidden duration
    ];
    Utils::dump("添加封禁成功", $Chatroom->add($params));

    Utils::dump("添加封禁参数错误", $Chatroom->add());

    $params = [
        'id' => 'watergroup1',
        'members' => [
            ['id' => 'group9994']
        ],
        'minute' => 0
    ];
    Utils::dump("添加封禁 minute 错误", $Chatroom->add($params));

    $params = [
        'id' => 'watergroup1',// Group ID
        'members' => [ // Banned personnel list
                       ['id' => 'group9994']
        ]
    ];
    Utils::dump("解除封禁成功", $Chatroom->remove($params));

    Utils::dump("解除封禁参数错误", $Chatroom->remove());
    $params = [
        'id' => 'watergroup1',
        'members' => []
    ];
    Utils::dump("解除封禁 members 错误", $Chatroom->remove($params));

    $params = [
        'id' => 'watergroup1',// group id
    ];
    Utils::dump("查询被封禁成员列表成功", $Chatroom->getList($params));

    Utils::dump("查询被封禁成员列表参数错误", $Chatroom->getList());
}

testChatroomBlock($RongSDK);

function testChatroomDemotion($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Demotion();
    $params = [
        'msgs' => ['RC:TxtMsg03', 'RC:TxtMsg02']// Message type list
    ];
    Utils::dump("添加应用内聊天室降级消息成功", $Chatroom->add($params));

    Utils::dump("添加应用内聊天室降级消息参数错误", $Chatroom->add());

    $params = [
        'msgs' => ['RC:TxtMsg03', 'RC:TxtMsg02']// Message type list
    ];
    Utils::dump("移除应用内聊天室降级消息成功", $Chatroom->remove($params));

    Utils::dump("移除应用内聊天室降级消息参数错误", $Chatroom->remove());

    Utils::dump("获取应用内聊天室降级消息成功", $Chatroom->getList());
}

testChatroomDemotion($RongSDK);

function testChatroomDistribute($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Distribute();
    $params = [
        'id' => "Txtmsg03"// chatroom id
    ];
    Utils::dump("停止聊天室消息分发成功", $Chatroom->stop($params));

    Utils::dump("停止聊天室消息分发参数错误", $Chatroom->stop());

    $params = [
        'id' => "Txtmsg03"// chatroom id
    ];
    Utils::dump("恢复聊天室消息分发成功", $Chatroom->resume($params));

    Utils::dump("恢复聊天室消息分发参数错误", $Chatroom->resume());

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
    Utils::dump("添加聊天室成员禁言成功", $Chatroom->add($params));

    Utils::dump("添加聊天室成员禁言参数错误", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chat room id
        'members' => [
            ['id' => 'seal9901']// Personnel ID
        ],
    ];
    Utils::dump("解除聊天室成员禁言成功", $Chatroom->remove($params));

    Utils::dump("解除聊天室成员禁言参数错误", $Chatroom->remove());

    $params = [
        'id' => 'ujadk90ha',// chatroom id
    ];
    Utils::dump("获取聊天室成员禁言列表成功", $Chatroom->getList($params));

    Utils::dump("获取聊天室成员禁言列表参数错误", $Chatroom->getList());

}

testChatroomGag($RongSDK);

function testChatroomMuteAllMembers($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->MuteAllMembers();
    $params = [
        'id' => 'chatroom001',// //chatroom id
    ];
    Utils::dump("添加聊天室全体禁言成功", $Chatroom->add($params));

    Utils::dump("添加聊天室全体禁言参数错误", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chatroom ID
    ];
    Utils::dump("解除聊天室全体禁言成功", $Chatroom->remove($params));

    Utils::dump("解除聊天室全体禁言参数错误", $Chatroom->remove());

    Utils::dump("检查聊天室全体禁言成功", $Chatroom->check($params));

    Utils::dump("检查聊天室全体禁言成功参数错误", $Chatroom->check());

    Utils::dump("获取添加聊天室全体禁言列表成功", $Chatroom->getList(1,50));
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
    Utils::dump("添加聊天室全体禁言白名单成功", $Chatroom->add($params));

    Utils::dump("添加聊天室全体禁言白名单参数错误", $Chatroom->add());

    Utils::dump("移除聊天室全体禁言白名单成功", $Chatroom->remove($params));

    Utils::dump("移除聊天室全体禁言白名单参数错误", $Chatroom->remove());


    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("获取添加聊天室全体禁言白名单列表成功", $Chatroom->getList($params));
}

testChatroomMuteWhiteList($RongSDK);

function testChatroomKeepalive($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Keepalive();
    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("添加保活聊天室成功", $Chatroom->add($params));

    Utils::dump("添加保活聊天室参数错误", $Chatroom->add());

    $params = [
        'id' => 'ujadk90ha',// Chatroom ID
/* Chatroom ID */
    ];
    Utils::dump("删除保活聊天室成功", $Chatroom->remove($params));

    Utils::dump("删除保活聊天室参数错误", $Chatroom->remove());

    Utils::dump("获取保活聊天室列表成功", $Chatroom->getList());
}

testChatroomKeepalive($RongSDK);

function testChatroomWhitelistUser($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->User();
    $params = [
        "id" => "seal9901",// Chat room ID
        "members" => [
            ["id" => "user1"], // User ID
            ["id" => "user2"]
        ]
    ];
    Utils::dump("添加聊天室用户白名单成功", $Chatroom->add($params));

    Utils::dump("添加聊天室用户白名单参数错误", $Chatroom->add());

    $params = [
        "id" => "seal9901",// Chat room ID
        "members" => [
            ["id" => "user1"], // User ID
            ["id" => "user2"]
        ]
    ];
    Utils::dump("移除聊天室用户白名单成功", $Chatroom->remove($params));

    Utils::dump("移除聊天室用户白名单参数错误", $Chatroom->remove());

    $params = [
        "id" => "seal9901",// chatroom id
    ];
    Utils::dump("获取聊天室用户白名单成功", $Chatroom->getList($params));

    Utils::dump("获取聊天室用户白名单参数错误", $Chatroom->getList());
}

testChatroomWhitelistUser($RongSDK);

function testChatroomWhitelistMessage($RongSDK) {
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->Message();
    $params = [
        'msgs' => ["RC:TxtMsg"]// Message Type List
    ];
    Utils::dump("添加聊天室消息白名单成功", $Chatroom->add($params));

    Utils::dump("添加聊天室消息白名单参数错误", $Chatroom->add());

    Utils::dump("获取聊天室消息白名单成功", $Chatroom->getList());

    $params = [
        'msgs' => ["RC:TxtMsg"]// Message type list
    ];
    Utils::dump("移除聊天室消息白名单成功", $Chatroom->remove($params));

    Utils::dump("移除聊天室消息白名单参数错误", $Chatroom->remove());

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
    Utils::dump("设置聊天室属性成功", $Chatroom->set($params));
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
        'content' => '{"type":1,"key":"name","value":"主播","extra":""}',// Chat room attribute corresponding value
    ];
    Utils::dump("设置聊天室属性成功(全部参数)", $Chatroom->set($params));

    Utils::dump("设置聊天室属性参数错误", $Chatroom->set());

    $params = [
        'id' => 'chatroom001',// Chat room ID
        'userId' => 'userId01',// Operation user ID
        'key' => 'key001',// Chat room attribute name
    ];
    Utils::dump("删除聊天室属性成功", $Chatroom->remove($params));

    Utils::dump("删除聊天室属性参数错误", $Chatroom->remove());

    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    Utils::dump("获取聊天室属性(全部)", $Chatroom->query($params));
    $params = [
        'id' => 'chatroom001',// Chat room ID
        'keys' => [
            ['key' => 'key004'],
            ['key' => 'key005']
        ]
    ];
    Utils::dump("获取聊天室属性(部分)", $Chatroom->query($params));
}

testChatroomEntry($RongSDK);