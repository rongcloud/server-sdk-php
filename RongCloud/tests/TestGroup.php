<?php
/**
 * Group module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testGroup($RongSDK){
    $Group = $RongSDK->getGroup();
    $params = [
        'id'=> 'ujadk90ha',// User ID
        'groups'=>[['id'=> 'group9998', 'name'=> 'RongCloud']]// User group information
    ];
    Utils::dump("群组信息同步成功",$Group->sync($params));

    Utils::dump("设置用户某个会话 Push 屏蔽 id 错误",$Group->sync());

    $params = [
        'id'=> 'watergroup1',// Group ID
        'name'=> 'watergroup',// Group name
        'members'=>[          // Member List
            ['id'=> 'group9991111113']
        ]
    ];
    Utils::dump("创建群组成功",$Group->create($params));

    Utils::dump("创建群组错误",$Group->create());

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>"watergroup",// Group Name
        'member'=>['id'=> 'group999'],// Group member information
    ];
    Utils::dump("加入群组成功",$Group->joins($params));

    Utils::dump("加入群组 member 错误",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("加入群组 id 错误",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',// Group ID
        'member'=>['id'=> 'group999']// Exit personnel information
    ];
    Utils::dump("退出群组成功",$Group->quit($params));

    Utils::dump("退出群组 id 错误",$Group->quit());

    $params = [
        'id'=> 'watergroup',// Group ID
        'member'=>['id'=> 'group999']// Exiting personnel information
    ];
    Utils::dump("解散群组成功",$Group->dismiss($params));

    Utils::dump("解散群组 id 错误",$Group->dismiss());

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("修改群信息成功",$Group->update($params));

    $params = [
        'id'=> '',// Group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("修改群信息 id 错误",$Group->update($params));

    $params = [
        'id'=> 'watergroup',// Group ID
        'name'=>""// group name
    ];
    Utils::dump("修改群信息 name 错误",$Group->update($params));

}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getGroup()->Gag();
    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[ // Forbidden personnel list
            ['id'=> 'group9994']
        ],
        'minute'=>500  // Forbidden duration
    ];
    Utils::dump("添加群组禁言成功",$Group->add($params));

    Utils::dump("添加群组禁言参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',
        'members'=>[
            ['id'=> 'group9994']
        ],
        'minute'=>0
    ];
    Utils::dump("添加群组禁言 minute 错误",$Group->add($params));

    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[ // Forbidden personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除禁言成功",$Group->remove($params));

    Utils::dump("解除禁言参数错误",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("解除禁言 members 错误",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("查询禁言成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言成员列表参数错误",$Group->getList());
}

testGroupGag($RongSDK);



function testGroupMuteAllMembers($RongSDK){
    $Group = $RongSDK->getGroup()->MuteAllMembers();
    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("添加指定群组全部禁言成功",$Group->add($params));

    Utils::dump("添加指定群组全部禁言参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',// group id
    ];
    Utils::dump("解除指定群组全部禁言成功",$Group->remove($params));

    Utils::dump("解除指定群组全部禁言参数错误",$Group->remove());

    $params = [

    ];
    Utils::dump("查询指定群组全部禁言列表成功",$Group->getList($params));
}

testGroupMuteAllMembers($RongSDK);


function testGroupMuteWhiteList($RongSDK){
    $Group = $RongSDK->getGroup()->MuteWhiteList();
    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[ // Prohibited personnel list
            ['id'=> 'group9994']
        ],
    ];
    Utils::dump("添加群组禁言白名单成功",$Group->add($params));

    Utils::dump("添加群组禁言白名单参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Group ID
        'members'=>[ // Forbidden personnel whitelist
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除禁言白名单成功",$Group->remove($params));

    Utils::dump("解除禁言白名单参数错误",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("解除禁言白名单 members 错误",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',// @param group id
    ];
    Utils::dump("查询禁言白名单成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言白名单成员列表参数错误",$Group->getList());
}

testGroupMuteWhiteList($RongSDK);

function testGroupRemark($RongSDK){
    $Group = $RongSDK->getGroup()->Remark();
    $params = [
        'userId'=> 'ujadk90ha1',// @param personnel id
        'groupId'=>'groupId', // Group ID
        'remark'=> '人员备注'// Group annotation
    ];
    Utils::dump("添加群组人员备注成功",$Group->set($params));

    Utils::dump("添加群组人员备注参数错误",$Group->set());

    $params = [
        'userId'=> 'ujadk90ha1',// Staff ID
        'groupId'=>'groupId', // Group ID
    ];
    Utils::dump("移除群组人员备注成功",$Group->del($params));

    Utils::dump("移除群组人员备注参数错误",$Group->del());

    Utils::dump("获取群组人员备注成功",$Group->get($params));

    Utils::dump("获取群组人员备注参数错误",$Group->get());
}

testGroupRemark($RongSDK);
