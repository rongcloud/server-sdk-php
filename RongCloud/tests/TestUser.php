<?php
/**
 * 用户模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testUser($RongSDK){
    $portrait = "http://7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982";
    $User = $RongSDK->getUser();

    $params = [
        'id'=> 'ujadk90had',//用户id
        'name'=> 'test',//用户名称
        'portrait'=> $portrait //用户头像
    ];
    Utils::dump("用户注册成功",$User->register($params));

    Utils::dump("用户注册 id 错误", $User->register());

    $params = [
        'id'=> 'ujadk90had',
        'name'=> '',
        'portrait'=> $portrait
    ];
    Utils::dump("用户注册 name 错误",$User->register($params));

    $params = [
        'id'=> 'ujadk90had',
        'name'=> Utils::createRand(66),
        'portrait'=> $portrait
    ];
    Utils::dump("用户注册 name 长度错误",$User->register($params));

    $params = [
        'id'=> 'ujadk90had',
        'name'=> '测试用户',
        'portrait'=> Utils::createRand(513)
    ];
    Utils::dump("用户注册 portrait 错误",$User->register($params));

    $params = [
        'id'=> 'ujadk90had',
        'name'=> '新用户',
        'portrait'=> $portrait
    ];
    Utils::dump("用户更新成功",$User->update($params));

    Utils::dump("用户更新 id 错误", $User->update());

    $params = [
        'id'=> 'ujadk90had',
        'name'=> '',
        'portrait'=> $portrait
    ];
    Utils::dump("用户更新 name 错误",$User->update($params));

    $params = [
        'id'=> 'ujadk90had',
        'name'=> Utils::createRand(66),
        'portrait'=> $portrait
    ];
    Utils::dump("用户更新 name 长度错误",$User->update($params));

    $params = [
        'id'=> 'ujadk90had',
        'name'=> '测试用户',
        'portrait'=> Utils::createRand(513)
    ];
    Utils::dump("用户更新 portrait 错误",$User->update($params));
}

testUser($RongSDK);

function testUserBlock($RongSDK){
    $User = $RongSDK->getUser()->Block();

    $params = [
        'id'=> 'ujadk90had',//封禁用户id 唯一标识，最大长度 30 个字符
        'minute'=> 20 //封禁时长 1 - 1 * 30 * 24 * 60 分钟
    ];
    Utils::dump("添加封禁用户成功",$User->add($params));

    Utils::dump("添加封禁用户 id 错误", $User->add());

    $params = [
        'id'=> 'ujadk90ha1d',
        'minute'=> 0
    ];
    Utils::dump("添加封禁用户 minute 错误",$User->add($params));

    $params = [
        'id'=> 'ujadk90ha1d',
        'minute'=> 1 * 30 * 24 * 60*2
    ];
    Utils::dump("添加封禁用户 minute 大小错误",$User->add($params));


    $params = [
        'id'=> 'ujadk90had',
    ];
    Utils::dump("移除封禁用户成功",$User->remove($params));

    Utils::dump("移除封禁用户 id 错误",$User->remove());

    Utils::dump("封禁用户获取成功",$User->getList());
}

testUserBlock($RongSDK);

function testUserBlacklist($RongSDK){
    $User = $RongSDK->getUser()->Blacklist();

    $params = [
        'id'=> 'ujadk90ha1d',//用户 id
        'blacklist'=> ['ujadk90ha1d']//添加黑名单人员列表
    ];
    Utils::dump("用户黑名单添加成功",$User->add($params));

    Utils::dump("用户黑名单 id 错误", $User->add());

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("用户黑名单 blacklist 错误",$User->add($params));


    $params = [
        'id'=> 'ujadk90ha1d',//用户 id
        'blacklist'=> ['ujadk90ha1d']//添加黑名单人员列表
    ];
    Utils::dump("移除用户黑名单成功",$User->add($params));

    Utils::dump("移除用户黑名单 id 错误", $User->add());

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("移除用户黑名单 blacklist 错误",$User->add($params));

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("用户黑名单获取成功",$User->getList($params));


    Utils::dump("用户黑名单获取 id 错误",$User->getList());
}

testUserBlacklist($RongSDK);

function testUserOnlinestatus($RongSDK){
    $User = $RongSDK->getUser()->Onlinestatus();

    $params = [
        'id'=> 'ujadk90ha1d',//用户 id
    ];
    Utils::dump("用户在线状态获取成功",$User->check($params));

    Utils::dump("用户在线状态参数错误", $User->check());

}

testUserOnlinestatus($RongSDK);


function testUserMuteGroups($RongSDK){
    $Group = $RongSDK->getUser()->MuteGroups();
    $params = [
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ],
        'minute'=>500  //	禁言时长
    ];
    Utils::dump("添加群组禁言成功",$Group->add($params));

    Utils::dump("添加群组禁言参数错误",$Group->add());

    $params = [
        'members'=>[
            ['id'=> 'group9994']
        ],
        'minute'=>0
    ];
    Utils::dump("添加群组禁言 minute 错误",$Group->add($params));

    $params = [
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除群组禁言成功",$Group->remove($params));

    Utils::dump("解除群组禁言参数错误",$Group->remove());
    $params = [
        'members'=>[]
    ];
    Utils::dump("解除群组禁言 members 错误",$Group->remove($params));

    $params = [

    ];
    Utils::dump("查询群组禁言成员列表成功",$Group->getList($params));

}

testUserMuteGroups($RongSDK);

function testUserMuteChatrooms($RongSDK){
    $Chatroom = $RongSDK->getUser()->MuteChatrooms();
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
testUserMuteChatrooms($RongSDK);


function testUserTag($RongSDK){
    $Chatroom = $RongSDK->getUser()->Tag();
    $params = [
        'userId'=> 'ujadk90ha1',//用户id
        'tags'=> ['标签1','标签2']//用户标签
    ];
    Utils::dump("添加用户标签成功",$Chatroom->set($params));

    Utils::dump("添加用户标签参数错误",$Chatroom->set());

    $params = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],//用户id
        'tags'=> ['标签1','标签2']//用户标签
    ];
    Utils::dump("批量添加用户标签成功",$Chatroom->batchset($params));

    Utils::dump("批量添加用户标签参数错误",$Chatroom->batchset());

    $params = [
        'userIds'=> ['ujadk90ha1','ujadk90ha2'],//用户id
    ];
    Utils::dump("获取用户标签成功",$Chatroom->get($params));

    Utils::dump("获取用户标签参数错误",$Chatroom->get());

}
testUserTag($RongSDK);

function testUserWhitelist($RongSDK){
    $User = $RongSDK->getUser()->Whitelist();

    $params = [
        'id'=> 'ujadk90ha1d',//用户 id
        'whitelist'=> ['ujadk90ha1d']//添加黑名单人员列表
    ];
    Utils::dump("用户白名单添加成功",$User->add($params));

    Utils::dump("用户白名单 id 错误", $User->add());

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("用户白名单 whitelist 错误",$User->add($params));


    $params = [
        'id'=> 'ujadk90ha1d',//用户 id
        'whitelist'=> ['ujadk90ha1d']//添加黑名单人员列表
    ];
    Utils::dump("移除用户白名单成功",$User->add($params));

    Utils::dump("移除用户白名单 id 错误", $User->add());

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("移除用户白名单 whitelist 错误",$User->add($params));

    $params = [
        'id'=> 'ujadk90ha1d',
    ];
    Utils::dump("用户白名单获取成功",$User->getList($params));


    Utils::dump("用户白名单获取 id 错误",$User->getList());
}

testUserWhitelist($RongSDK);
