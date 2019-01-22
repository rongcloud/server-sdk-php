<?php
/**
 * 群组模块测试用例
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
        'id'=> 'ujadk90ha',//用户id
        'groups'=>[['id'=> 'group9998', 'name'=> 'RongCloud']]//用户群组信息
    ];
    Utils::dump("群组信息同步成功",$Group->sync($params));

    Utils::dump("设置用户某个会话 Push 屏蔽 id 错误",$Group->sync());

    $params = [
        'id'=> 'watergroup1',//群组 id
        'name'=> 'watergroup',//群组名称
        'members'=>[          //群成员 列表
            ['id'=> 'group9991111113']
        ]
    ];
    Utils::dump("创建群组成功",$Group->create($params));

    Utils::dump("创建群组错误",$Group->create());

    $params = [
        'id'=> 'watergroup',//群组 id
        'name'=>"watergroup",//群组名称
        'member'=>['id'=> 'group999'],//群成员信息
    ];
    Utils::dump("加入群组成功",$Group->joins($params));

    Utils::dump("加入群组 member 错误",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("加入群组 id 错误",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',//群组 id
        'member'=>['id'=> 'group999']//退出人员信息
    ];
    Utils::dump("退出群组成功",$Group->quit($params));

    Utils::dump("退出群组 id 错误",$Group->quit());

    $params = [
        'id'=> 'watergroup',//群组 id
        'member'=>['id'=> 'group999']//退出人员信息
    ];
    Utils::dump("解散群组成功",$Group->dismiss($params));

    Utils::dump("解散群组 id 错误",$Group->dismiss());

    $params = [
        'id'=> 'watergroup',//群组 id
        'name'=>"watergroup"//群名称
    ];
    Utils::dump("修改群信息成功",$Group->update($params));

    $params = [
        'id'=> '',//群组 id
        'name'=>"watergroup"//群名称
    ];
    Utils::dump("修改群信息 id 错误",$Group->update($params));

    $params = [
        'id'=> 'watergroup',//群组 id
        'name'=>""//群名称
    ];
    Utils::dump("修改群信息 name 错误",$Group->update($params));

}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getGroup()->Gag();
    $params = [
        'id'=> 'watergroup1',//群组 id
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ],
        'minute'=>500  //	禁言时长
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
        'id'=> 'watergroup1',//群组 id
        'members'=>[ //禁言人员列表
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
        'id'=> 'watergroup1',//群组 id
    ];
    Utils::dump("查询禁言成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言成员列表参数错误",$Group->getList());
}

testGroupGag($RongSDK);


