<?php

/**
 * // User module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY, APPSECRET);

/**
 * testUser
 *
 * @param RongCloud $RongSDK
 * @return void
 */
function testUser($RongSDK)
{
    $portrait = "http:// 7xogjk.com1.z0.glb.clouddn.com/IuDkFprSQ1493563384017406982";
    $User = $RongSDK->getUser();

    $params = [
        'id' => 'ujadk90had', // // User ID
        'name' => 'test', // Username
        'portrait' => $portrait // // User avatar
    ];
    Utils::dump("用户注册成功", $User->register($params));

    Utils::dump("用户注册 id 错误", $User->register());

    $params = [
        'id' => 'ujadk90had',
        'name' => '',
        'portrait' => $portrait
    ];
    Utils::dump("用户注册 name 错误", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => Utils::createRand(66),
        'portrait' => $portrait
    ];
    Utils::dump("用户注册 name 长度错误", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '测试用户',
        'portrait' => Utils::createRand(513)
    ];
    Utils::dump("用户注册 portrait 错误", $User->register($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '新用户',
        'portrait' => $portrait
    ];
    Utils::dump("用户更新成功", $User->update($params));

    Utils::dump("用户更新 id 错误", $User->update());

    $params = [
        'id' => 'ujadk90had',
        'name' => '',
        'portrait' => $portrait
    ];
    Utils::dump("用户更新 name 错误", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => Utils::createRand(66),
        'portrait' => $portrait
    ];
    Utils::dump("用户更新 name 长度错误", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
        'name' => '测试用户',
        'portrait' => Utils::createRand(513)
    ];
    Utils::dump("用户更新 portrait 错误", $User->update($params));

    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("获取用户信息成功", $User->get($params));

    $params = [
        'id' => '55vW81Mni',
    ];
    Utils::dump("查询用户所在群组成功", $User->getGroups($params));


    $params = [
        'id' => ['55vW81Mni','kkj9o02'],
        'time' => 1623123911000
    ];
    Utils::dump("Token 失效", $User->expire($params));

    $params = [
        'id' => '55vW81Mni',
    ];
    Utils::dump("Token 失效，失败 time 为必填参数", $User->expire($params));
}

testUser($RongSDK);

function testUserBlock($RongSDK)
{
    $User = $RongSDK->getUser()->Block();

    $params = [
        'id' => 'ujadk90had', // // User ID, unique identifier, maximum length of 30 characters
        'minute' => 20 // // Blocking duration 1 - 1 * 30 * 24 * 60 minutes
    ];
    Utils::dump("添加封禁用户成功", $User->add($params));

    Utils::dump("添加封禁用户 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
        'minute' => 0
    ];
    Utils::dump("添加封禁用户 minute 错误", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
        'minute' => 1 * 30 * 24 * 60 * 2
    ];
    Utils::dump("添加封禁用户 minute 大小错误", $User->add($params));


    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("移除封禁用户成功", $User->remove($params));

    Utils::dump("移除封禁用户 id 错误", $User->remove());

    Utils::dump("封禁用户获取成功", $User->getList());
}

testUserBlock($RongSDK);

function testUserBlacklist($RongSDK)
{
    $User = $RongSDK->getUser()->Blacklist();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'blacklist' => ['ujadk90ha1d'] // // Add blacklist personnel list
    ];
    Utils::dump("用户黑名单添加成功", $User->add($params));

    Utils::dump("用户黑名单 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("用户黑名单 blacklist 错误", $User->add($params));


    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'blacklist' => ['ujadk90ha1d'] // // Add to blacklist personnel list
    ];
    Utils::dump("移除用户黑名单成功", $User->add($params));

    Utils::dump("移除用户黑名单 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("移除用户黑名单 blacklist 错误", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("用户黑名单获取成功", $User->getList($params));


    Utils::dump("用户黑名单获取 id 错误", $User->getList());
}

testUserBlacklist($RongSDK);

function testUserOnlinestatus($RongSDK)
{
    $User = $RongSDK->getUser()->Onlinestatus();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
    ];
    Utils::dump("用户在线状态获取成功", $User->check($params));

    Utils::dump("用户在线状态参数错误", $User->check());
}

testUserOnlinestatus($RongSDK);


function testUserMuteGroups($RongSDK)
{
    $Group = $RongSDK->getUser()->MuteGroups();
    $params = [
        'members' => [ // // Forbidden personnel list
            ['id' => 'group9994']
        ],
        'minute' => 500  // // Prohibition duration
    ];
    Utils::dump("添加群组禁言成功", $Group->add($params));

    Utils::dump("添加群组禁言参数错误", $Group->add());

    $params = [
        'members' => [
            ['id' => 'group9994']
        ],
        'minute' => 0
    ];
    Utils::dump("添加群组禁言 minute 错误", $Group->add($params));

    $params = [
        'members' => [ // // Forbidden personnel list
            ['id' => 'group9994']
        ]
    ];
    Utils::dump("解除群组禁言成功", $Group->remove($params));

    Utils::dump("解除群组禁言参数错误", $Group->remove());
    $params = [
        'members' => []
    ];
    Utils::dump("解除群组禁言 members 错误", $Group->remove($params));

    $params = [];
    Utils::dump("查询群组禁言成员列表成功", $Group->getList($params));
}

testUserMuteGroups($RongSDK);

function testUserMuteChatrooms($RongSDK)
{
    $Chatroom = $RongSDK->getUser()->MuteChatrooms();
    $params = [
        'members' => [
            ['id' => 'seal9901'] // Personnel ID
        ],
        'minute' => 30 // // Prohibited duration
    ];
    Utils::dump("添加聊天室全局禁言成功", $Chatroom->add($params));

    Utils::dump("添加聊天室全局禁言参数错误", $Chatroom->add());

    $params = [
        'members' => [
            ['id' => 'seal9901'] // Personnel ID
        ],
    ];
    Utils::dump("解除聊天室全局禁言成功", $Chatroom->remove($params));

    Utils::dump("解除聊天室全局禁言错误", $Chatroom->remove());

    $params = [];
    Utils::dump("获取聊天室全局禁言列表成功", $Chatroom->getList($params));
}
testUserMuteChatrooms($RongSDK);


function testUserTag($RongSDK)
{
    $Chatroom = $RongSDK->getUser()->Tag();
    $params = [
        'userId' => 'ujadk90ha1', // // User ID
        'tags' => ['标签1', '标签2'] // User label
    ];
    Utils::dump("添加用户标签成功", $Chatroom->set($params));

    Utils::dump("添加用户标签参数错误", $Chatroom->set());

    $params = [
        'userIds' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
        'tags' => ['标签1', '标签2'] // // User label
    ];
    Utils::dump("批量添加用户标签成功", $Chatroom->batchset($params));

    Utils::dump("批量添加用户标签参数错误", $Chatroom->batchset());

    $params = [
        'userIds' => ['ujadk90ha1', 'ujadk90ha2'], // // User ID
    ];
    Utils::dump("获取用户标签成功", $Chatroom->get($params));

    Utils::dump("获取用户标签参数错误", $Chatroom->get());
}
testUserTag($RongSDK);

function testUserWhitelist($RongSDK)
{
    $User = $RongSDK->getUser()->Whitelist();

    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'whitelist' => ['ujadk90ha1d'] // // Add blacklist personnel list
    ];
    Utils::dump("用户白名单添加成功", $User->add($params));

    Utils::dump("用户白名单 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("用户白名单 whitelist 错误", $User->add($params));


    $params = [
        'id' => 'ujadk90ha1d', // User ID
        'whitelist' => ['ujadk90ha1d'] // // Add blacklist personnel list
    ];
    Utils::dump("移除用户白名单成功", $User->add($params));

    Utils::dump("移除用户白名单 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("移除用户白名单 whitelist 错误", $User->add($params));

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("用户白名单获取成功", $User->getList($params));


    Utils::dump("用户白名单获取 id 错误", $User->getList());
}

testUserWhitelist($RongSDK);


function testChatBan($RongSDK)
{
    $ban = $RongSDK->getUser()->Ban();
    $params = [
        'id' => ['kkj9o01', 'kkj9o02'],  // // Banned user Id, supports batch setting, with a maximum of no more than 1000.
        'state' => 1,                    // // Forbidden state, 0: Remove forbidden. 1: Add forbidden.
        'type' => 'PERSON',              // // conversation type, currently supports single conversation PERSON
    ];
    Utils::dump("设置用户单聊禁言", $ban->set($params));
    $params = [
        'state' => 1,
        'type' => 'PERSON',
    ];
    Utils::dump("设置用户单聊禁言 id 错误", $ban->set($params));
    $param = [
        'num'       => 101,     // // Get the number of rows, default is 100, maximum supported is 200.
        'offset'    => 0,       // // The starting position for the query, default is 0.
        'type'      => 'PERSON' // // Currently supports single-person conversation type PERSON.
    ];
    Utils::dump("查询单聊禁言用户列表", $ban->getList($param));
}

testChatBan($RongSDK);

function testUserRemark($RongSDK)
{
    $remark = $RongSDK->getUser()->Remark();
    $params = [
        'userId' => 'kkj9o01',
        'remarks'=>json_encode([["id"=>"userid1","remark"=>"remark1"]])
    ];
    Utils::dump("设置用户备注", $remark->set($params));
    $params = [
    ];
    Utils::dump("设置用户备注 userId 错误", $remark->set($params));

    $params = [
        'userId' => 'kkj9o01',
        'targetId'=>"friendId"
    ];
    Utils::dump("删除用户备注", $remark->del($params));
    $params = [
    ];
    Utils::dump("删除用户备注 userId 错误", $remark->del($params));
    $params = [
        'userId' => 'kkj9o01',
        'size'=>50,
        'page'=>1
    ];
    Utils::dump("获取用户备注列表", $remark->get($params));
    $params = [
    ];
    Utils::dump("获取用户备注列表 userId 错误", $remark->get($params));
}

testUserRemark($RongSDK);



function testUserAbandon($RongSDK)
{
    $User = $RongSDK->getUser();
    $params = [
        'id' => 'kkj9o01',
    ];
    Utils::dump("deactivate users", $User->abandon($params));
    $params = [
    ];
    Utils::dump("deactivate users id 错误", $User->abandon($params));

    $params = [
        'id' => 'kkj9o01',
    ];
    Utils::dump("注销用户激活", $User->activate($params));
    $params = [
    ];
    Utils::dump("注销用户激活 id 错误", $User->activate($params));


    $params = [
        'size'=>50,
        'page'=>1
    ];
    Utils::dump("注销用户列表", $User->abandonQuery($params));
}

testUserAbandon($RongSDK);


function testBlockPushPeriod($RongSDK)
{
    $User = $RongSDK->getUser()->BlockPushPeriod();

    $params = [
        'id' => 'ujadk90had', // // User ID unique identifier, maximum length 30 characters
        'startTime' => "23:59:59",// // No interference start time
        'period'=>'600',// Do not disturb duration: minutes
        'level'=>1,// // Do Not Disturb Level 1 only notifies for private chats and @ messages, including @ specified users and @ all messages. Does not receive notifications, even for @ messages.
    ];
    Utils::dump("添加免打扰时段", $User->add($params));

    Utils::dump("添加免打扰时段 id 错误", $User->add());

    $params = [
        'id' => 'ujadk90ha1d',
    ];
    Utils::dump("添加免打扰时段 startTime 错误", $User->add($params));


    $params = [
        'id' => 'ujadk90had',
    ];
    Utils::dump("移除免打扰时段成功", $User->remove($params));

    Utils::dump("移除免打扰时段 id 错误", $User->remove());

    Utils::dump("免打扰时段获取成功", $User->getList($params));
}

testBlockPushPeriod($RongSDK);

/**
 * testProfile
 *
 * @param RongCloud $RongSDK
 * @return void
 */
function testProfile($RongSDK)
{
    $User = $RongSDK->getUser()->Profile();

    $params = [
        'userId' => 'ujadk90ha1', // // User ID
        'userProfile' => [
            'name' => 'testName',
            'email' => 'tester@rongcloud.cn'
        ],  // User basic information
        'userExtProfile' => [
            'ext_Profile1' => 'testpro1'
        ]  // // User extension information
    ];
    Utils::dump("用户资料设置", $User->set($params));

    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // User ID
    ];
    Utils::dump("用户托管信息清除", $User->clean($params));

    $params = [
        'userId' => ['ujadk90ha1', 'ujadk90ha2'], // // User ID
    ];
    Utils::dump("批量查询用户资料", $User->batchQuery($params));

    $params = [
        'page' => 1,
        'size' => 20,
        'order' => 0
    ];
    Utils::dump("分页获取应用全部用户列表", $User->query($params));

}
testProfile($RongSDK);

/**
 * // Paginate to retrieve the full list of application users
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'page' => 1,
        'size' => 20,
        'order' => 0
    ];
    $res =  $RongSDK->getUser()->Profile()->query($params);
    Utils::dump("分页获取应用全部用户列表", $res);
}