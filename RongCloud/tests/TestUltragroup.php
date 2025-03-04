<?php
/**
 * Super cluster module test case
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testGroup($RongSDK){
    $Group = $RongSDK->getUltragroup();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'name'=> 'watergroup',// Super group name
        'member'=>['id'=> 'group999'],// Create a userId
    ];
    Utils::dump("创建超级群成功",$Group->create($params));

    Utils::dump("创建超级群错误",$Group->create());

    $params = [
        'id'=> 'watergroup',// Supergroup ID
        'member'=>['id'=> 'group999'],// Group member information
    ];
    Utils::dump("加入超级群成功",$Group->joins($params));

    Utils::dump("加入超级群 member 错误",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("加入超级群 id 错误",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',// Super group ID
        'member'=>['id'=> 'group999']// Exit personnel information
    ];
    Utils::dump("退出超级群成功",$Group->quit($params));

    Utils::dump("退出超级群 id 错误",$Group->quit());

    $params = [
        'id'=> 'watergroup',// Supergroup ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("修改群信息成功",$Group->update($params));

    $params = [
        'id'=> '',// Super group ID
        'name'=>"watergroup"// group name
    ];
    Utils::dump("修改群信息 id 错误",$Group->update($params));

    $params = [
        'id'=> 'watergroup',// Super group ID
        'name'=>""// group name
    ];
    Utils::dump("修改群信息 name 错误",$Group->update($params));


    $params = [
        'id'=> 'watergroup',// ultra group id
    ];
    Utils::dump("解散超级群成功",$Group->dismiss($params));

    Utils::dump("解散超级群 id 错误",$Group->dismiss());
    $params = [
        'id'=> 'watergroup',// Super group ID
        'member'=>"userId1"// Member ID
    ];

    Utils::dump("超级群成员是否存在成功",$Group->isExist($params));

    Utils::dump("超级群成员是否存在 id 错误",$Group->isExist());



}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getUltragroup()->Gag();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[ // Prohibited personnel list
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("添加超级群禁言成功",$Group->add($params));

    Utils::dump("添加超级群禁言参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Supergroup ID
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
        'id'=> 'watergroup1',// ultra group id
    ];
    Utils::dump("查询禁言成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言成员列表参数错误",$Group->getList());
}

testGroupGag($RongSDK);



function testGroupMuteAllMembers($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteAllMembers();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'status'=>true
    ];
    Utils::dump("添加指定超级群全部禁言成功",$Group->set($params));

    Utils::dump("添加指定超级群全部禁言参数错误",$Group->set());

    $params = [
        'id'=> 'watergroup1',// ultra group id
    ];
    Utils::dump("查询指定超级群全部禁言列表成功",$Group->get($params));
}

testGroupMuteAllMembers($RongSDK);

function testGroupMuteWhiteList($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteWhiteList();
    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[ // Prohibited whitelist personnel list
            ['id'=> 'group9994']
        ],
    ];
    Utils::dump("添加超级群禁言白名单成功",$Group->add($params));

    Utils::dump("添加超级群禁言白名单参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',// Super group ID
        'members'=>[ // Prohibited whitelist personnel list
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
        'id'=> 'watergroup1',// Ultra group ID
    ];
    Utils::dump("查询禁言白名单成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言白名单成员列表参数错误",$Group->getList());
}

testGroupMuteWhiteList($RongSDK);

function testGroupBusChannel($RongSDK){
    $Group = $RongSDK->getUltragroup()->BusChannel();
    $params = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=> 'busChannel',// Super Group Channel
        'type'=>0
    ];
    Utils::dump("添加超级群频道成功",$Group->add($params));

    Utils::dump("添加超级群频道成功参数错误",$Group->add());

    Utils::dump("查询超级群频道列表成功",$Group->getList("phpgroup1"));

    Utils::dump("删除超级群频道成功",$Group->remove($params));

    Utils::dump("删除超级群频道错误",$Group->remove());

    Utils::dump("查询超级群频道列表参数错误",$Group->getList());

    Utils::dump("超级群频道类型切换成功",$Group->change($params));

    Utils::dump("超级群频道类型切换参数错误",$Group->change());

    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>'',
        'members'=>[ // Add supergroup private channel member
            ['id'=> 'Vu-oC0_LQ6kgPqltm_zYtI']
        ]
    ];

    Utils::dump("超级群私有频道成员添加",$Group->addPrivateUsers($group));

    Utils::dump("超级群私有频道成员添加参数错误",$Group->addPrivateUsers());

    Utils::dump("超级群私有频道成员移除",$Group->removePrivateUsers($group));

    Utils::dump("超级群私有频道成员移除参数错误",$Group->removePrivateUsers());

    $group = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=>'',
    ];

    Utils::dump("超级群私有频道成员获取成功",$Group->getPrivateUserList($group));

    Utils::dump("超级群私有频道成员获取参数错误",$Group->getPrivateUserList());

}

testGroupBusChannel($RongSDK);

function testGroupNotdisturb($RongSDK){
    $Group = $RongSDK->getUltragroup()->Notdisturb();
    $params = [
        'id'=> 'phpgroup1',// Super group ID
        'busChannel'=> 'busChannel',// Super group channel
        'unpushLevel'=>1
    ];
    Utils::dump("设置超级群免打扰",$Group->set($params));

    Utils::dump("设置超级群免打扰参数错误",$Group->set());

    $params = [
        'id'=> 'phpgroup1',// Super Group ID
        'busChannel'=> 'busChannel',// Super group channel
    ];
    Utils::dump("查询超级群免打扰",$Group->get($params));
}

testGroupNotdisturb($RongSDK);

