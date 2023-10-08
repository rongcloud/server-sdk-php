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
 * 设置聊天室属性（KV）
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
    Utils::dump("设置聊天室属性（KV）", $Entry);
}

set();


/**
 * 批量设置聊天室属性（KV）
 */
function batchSet() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    // 创建聊天室
    $RongSDK->getChatroom()->createV2(['id' => 'chatroom001']);

    $params = [
        'id' => 'chatroom001',//聊天室 id
        'autoDelete'=> 0,              //用户（entryOwnerId）退出聊天室后，是否删除此 Key 值
        'entryOwnerId'=> 'test',       //聊天室自定义属性的所属用户 ID
        'entryInfo'=> '{"key1":"value1","key2":"value2"}',//聊天室属性对应的值
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->batchSet($params);
    Utils::dump("批量设置聊天室属性（KV）", $Entry);
}

batchSet();


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