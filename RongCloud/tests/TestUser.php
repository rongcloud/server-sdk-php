<?php
/**
 * 用户模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

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

