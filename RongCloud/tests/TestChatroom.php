<?php
/**
 * 聊天室模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testChatroom($RongSDK){
    $Chatroom = $RongSDK->getChatroom();
    $params = [
        ['id'=> 'chatroom9992',
        'name'=> 'RongCloud']
    ];
    Utils::dump("创建聊天室成功",$Chatroom->create($params));

    Utils::dump("创建聊天室参数错误",$Chatroom->create());

    $params = [
        'id'=> 'watergroup1',
    ];
    Utils::dump("销毁聊天室成功",$Chatroom->destory($params));

    Utils::dump("销毁聊天室参数错误",$Chatroom->destory());

    $params = [
        'id'=> 'chatroom9992',
        'count'=>10,
        'order'=>2
    ];
    Utils::dump("获取聊天室信息成功",$Chatroom->get($params));

    Utils::dump("获取聊天室信息参数错误",$Chatroom->get());

    $params = [
        'id'=> 'chatroom9992',//聊天室 id
        'members'=>[
            ['id'=>"sea9902"]//人员id
        ]
    ];
    Utils::dump("检查用户是否在聊天室成功",$Chatroom->isExist($params));

    Utils::dump("检查用户是否在聊天室参数错误",$Chatroom->isExist());
}
testChatroom($RongSDK);

function testChatroomBan($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Ban();
    $params = [
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
        'minute'=>30//禁言时长
    ];
    Utils::dump("添加聊天室全局禁言成功",$Chatroom->add($params));

    Utils::dump("添加聊天室全局禁言参数错误",$Chatroom->add());

    $params = [
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
    ];
    Utils::dump("解除聊天室全局禁言成功",$Chatroom->remove($params));

    Utils::dump("解除聊天室全局禁言错误",$Chatroom->remove());

    $params = [

    ];
    Utils::dump("获取聊天室全局禁言列表成功",$Chatroom->getList($params));

}
testChatroomBan($RongSDK);

function testChatroomBlock($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Block();
    $params = [
        'id'=> 'watergroup1',//群组 id
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ],
        'minute'=>500  //	禁言时长
    ];
    Utils::dump("添加封禁成功",$Chatroom->add($params));

    Utils::dump("添加封禁参数错误",$Chatroom->add());

    $params = [
        'id'=> 'watergroup1',
        'members'=>[
            ['id'=> 'group9994']
        ],
        'minute'=>0
    ];
    Utils::dump("添加封禁 minute 错误",$Chatroom->add($params));

    $params = [
        'id'=> 'watergroup1',//群组 id
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除封禁成功",$Chatroom->remove($params));

    Utils::dump("解除封禁参数错误",$Chatroom->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("解除封禁 members 错误",$Chatroom->remove($params));

    $params = [
        'id'=> 'watergroup1',//群组 id
    ];
    Utils::dump("查询被封禁成员列表成功",$Chatroom->getList($params));

    Utils::dump("查询被封禁成员列表参数错误",$Chatroom->getList());
}
testChatroomBlock($RongSDK);

function testChatroomDemotion($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Demotion();
    $params = [
        'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// 消息类型列表
    ];
    Utils::dump("添加应用内聊天室降级消息成功",$Chatroom->add($params));

    Utils::dump("添加应用内聊天室降级消息参数错误",$Chatroom->add());

    $params = [
        'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// 消息类型列表
    ];
    Utils::dump("移除应用内聊天室降级消息成功",$Chatroom->remove($params));

    Utils::dump("移除应用内聊天室降级消息参数错误",$Chatroom->remove());

    Utils::dump("获取应用内聊天室降级消息成功",$Chatroom->getList());
}
testChatroomDemotion($RongSDK);

function testChatroomDistribute($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Distribute();
    $params = [
        'id'=> "Txtmsg03"//聊天室 id
    ];
    Utils::dump("停止聊天室消息分发成功",$Chatroom->stop($params));

    Utils::dump("停止聊天室消息分发参数错误",$Chatroom->stop());

    $params = [
        'id'=> "Txtmsg03"//聊天室 id
    ];
    Utils::dump("恢复聊天室消息分发成功",$Chatroom->resume($params));

    Utils::dump("恢复聊天室消息分发参数错误",$Chatroom->resume());

}
testChatroomDistribute($RongSDK);

function testChatroomGag($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Gag();
    $params = [
        'id'=> 'chatroom001',//聊天室 id
        'members'=> [
            ['id'=>'seal9901']//禁言人员 id
        ],
        'minute'=>30//禁言时长
    ];
    Utils::dump("添加聊天室成员禁言成功",$Chatroom->add($params));

    Utils::dump("添加聊天室成员禁言参数错误",$Chatroom->add());

    $params = [
        'id'=> 'ujadk90ha',//聊天室 id
        'members'=> [
            ['id'=>'seal9901']//人员 id
        ],
    ];
    Utils::dump("解除聊天室成员禁言成功",$Chatroom->remove($params));

    Utils::dump("解除聊天室成员禁言参数错误",$Chatroom->remove());

    $params = [
        'id'=> 'ujadk90ha',//聊天室 id
    ];
    Utils::dump("获取聊天室成员禁言列表成功",$Chatroom->getList($params));

    Utils::dump("获取聊天室成员禁言列表参数错误",$Chatroom->getList());

}

testChatroomGag($RongSDK);

function testChatroomKeepalive($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Keepalive();
    $params = [
        'id'=> 'chatroom001',//聊天室 id
    ];
    Utils::dump("添加保活聊天室成功",$Chatroom->add($params));

    Utils::dump("添加保活聊天室参数错误",$Chatroom->add());

    $params = [
        'id'=> 'ujadk90ha',//聊天室 id
    ];
    Utils::dump("删除保活聊天室成功",$Chatroom->remove($params));

    Utils::dump("删除保活聊天室参数错误",$Chatroom->remove());

    Utils::dump("获取保活聊天室列表成功",$Chatroom->getList());
}

testChatroomKeepalive($RongSDK);

testChatroomGag($RongSDK);

function testChatroomWhitelistUser($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->User();
    $params = [
        "id"=>"seal9901",//聊天室 id
        "members"=>[
            ["id"=>"user1"], //用户 id
            ["id"=>"user2"]
        ]
    ];
    Utils::dump("添加聊天室用户白名单成功",$Chatroom->add($params));

    Utils::dump("添加聊天室用户白名单参数错误",$Chatroom->add());

    $params = [
        "id"=>"seal9901",//聊天室 id
        "members"=>[
            ["id"=>"user1"], //用户 id
            ["id"=>"user2"]
        ]
    ];
    Utils::dump("移除聊天室用户白名单成功",$Chatroom->remove($params));

    Utils::dump("移除聊天室用户白名单参数错误",$Chatroom->remove());

    $params = [
        "id"=>"seal9901",//聊天室 id
    ];
    Utils::dump("获取聊天室用户白名单成功",$Chatroom->getList($params));

    Utils::dump("获取聊天室用户白名单参数错误",$Chatroom->getList());
}

testChatroomWhitelistUser($RongSDK);

function testChatroomWhitelistMessage($RongSDK){
    $Chatroom = $RongSDK->getChatroom()->Whitelist()->Message();
    $params = [
        'msgs'=> ["RC:TxtMsg"]//消息类型列表
    ];
    Utils::dump("添加聊天室消息白名单成功",$Chatroom->add($params));

    Utils::dump("添加聊天室消息白名单参数错误",$Chatroom->add());

    Utils::dump("获取聊天室消息白名单成功",$Chatroom->getList());

    $params = [
        'msgs'=> ["RC:TxtMsg"]//消息类型列表
    ];
    Utils::dump("移除聊天室消息白名单成功",$Chatroom->remove($params));

    Utils::dump("移除聊天室消息白名单参数错误",$Chatroom->remove());

}

testChatroomWhitelistMessage($RongSDK);
