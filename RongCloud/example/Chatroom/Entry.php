<?php
/**
 * // Chat room property settings
 */

use RongCloud\Lib\Utils;
use RongCloud\RongCloud;

require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');


/**
 * Set chat room attributes (KV)
 */
function set() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    // // Create a chat room
    $RongSDK->getChatroom()->create(['id' => 'chatroom001', 'name' => 'RongCloud']);

    $params = [
        'id' => 'chatroom001',// // Chat room ID
        'userId' => 'userId01',// // Operator User Id
        'key' => 'key01',// // Chat room attribute name
        'value' => 'value01',// // The value corresponding to the chat room attribute
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->set($params);
    Utils::dump("设置聊天室属性（KV）", $Entry);
}

set();


/**
 * // Batch set chat room properties (KV)
 */
function batchSet() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    // Create a chat room
    $RongSDK->getChatroom()->createV2(['id' => 'chatroom001']);

    $params = [
        'id' => 'chatroom001',// // Chat room ID
        'autoDelete'=> 0,              // // Whether to delete this key value after the user (entryOwnerId) exits the chat room
        'entryOwnerId'=> 'test',       // // Custom attribute of the chat room's user ID
        'entryInfo'=> '{"key1":"value1","key2":"value2"}',// // Chat room attribute corresponding value
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->batchSet($params);
    Utils::dump("批量设置聊天室属性（KV）", $Entry);
}

batchSet();


/**
 * // Get chat room properties
 */
function query() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);

    $params = [
        'id' => 'chatroom001',// chatroom id
    ];
    $Entry = $RongSDK->getChatroom()->Entry()->query($params);
    Utils::dump("获取聊天室属性", $Entry);
}

query();

/**
 * // Delete chat room attribute
 */
function remove() {
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $params = [
        'id' => 'chatroom001',// // Chat room id
        'userId' => 'userId01',// Operator User ID
        'key' => 'key01',// // Chat room attribute name
    ];

    $Entry = $RongSDK->getChatroom()->Entry()->remove($params);
    Utils::dump("删除聊天室属性", $Entry);
}

remove();