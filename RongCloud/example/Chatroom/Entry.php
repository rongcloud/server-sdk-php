<?php
/**
 * 聊天室属性设置
 */

use RongCloud\Lib\Utils;
use RongCloud\RongCloud;

require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');


/**
 * 添加保活聊天室
 */
function set() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    // 创建聊天室
    $RongSDK->getChatroom()->create(['id' => 'chatroom001', 'name' => 'RongCloud']);

    $params = [
        'id' => 'chatroom001',//聊天室 id
        'userId' => 'userId01',//操作用户 Id
        'key' => 'key01',//聊天室属性名称
        'value' => 'value01',//聊天室属性对应的值
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->set($params);
    Utils::dump("设置聊天室属性", $Entry);
}

set();

/**
 * 获取聊天室属性
 */
function query() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    $params = [
        'id' => 'chatroom001',//聊天室 id
    ];
    $Entry = $RongSDK->getChatroom()->Entry()->query($params);
    Utils::dump("获取聊天室属性", $Entry);
}

query();

/**
 * 删除聊天室属性
 */
function remove() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'id' => 'chatroom001',//聊天室 id
        'userId' => 'userId01',//操作用户 Id
        'key' => 'key01',//聊天室属性名称
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->remove($params);
    Utils::dump("删除聊天室属性", $Entry);
}

remove();