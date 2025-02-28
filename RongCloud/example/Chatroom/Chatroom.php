<?php
/**
 * chatroom
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * // Create a chat room
 */
function create()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        ['id'=> 'phpchatroom4',// // Chat room ID
        'name'=> 'phpchatroom1']// // Chatroom name
    ];
    $result = $RongSDK->getChatroom()->create($chatroom);
    Utils::dump("创建聊天室",$result);
}
create();

/**
 * Create Chat Room V2
 */
function createV2()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'phpchatroom4',  // // Chat room id
        'destroyType'=> 0,      // // Specifies the destruction type of the chat room 0: default value, indicates destruction when inactive, 1: fixed time destruction
        'isBan' => true,        // // Whether to ban all members of the chat room, default false
        'whiteUserIds' => ['user1','user2'] // // Forbidden whitelist user list, supports batch settings, maximum not exceeding 20
    ];
    $result = $RongSDK->getChatroom()->createV2($chatroom);
    Utils::dump("创建聊天室V2",$result);
}
createV2();

/**
 * // Query chat room basic information
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
                'id'=> ['aaa','bbb','ccc'],// // @param chatroom id - The unique identifier for the chatroom.
                ];
    $result = $RongSDK->getChatroom()->query($chatroom);
    Utils::dump("查询聊天室基础信息",$result);
}
query();

/**
 * // Query chat room basic information V2
 */
function queryV2()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'aaa'];// // Chatroom ID
    $result = $RongSDK->getChatroom()->queryV2($chatroom);
    Utils::dump("查询聊天室基础信息V2",$result);
}
queryV2();

/**
 * // Get chat room members
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
                'id'=> 'phpchatroom4',// // Chat room id
                'count'=>10,
                'order'=>1
                ];
    $result = $RongSDK->getChatroom()->get($chatroom);
    Utils::dump("获取聊天室成员",$result);
}
get();

/**
 * // Set chat room destruction type
 */
function setDestroyType()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'phpchatroom','destroyType'=> 0,'destroyTime'=> 60];// // chatroom id
    $result = $RongSDK->getChatroom()->setDestroyType($chatroom);
    Utils::dump("设置聊天室销毁类型",$result);
}
setDestroyType();

/**
 * // Destroy chat room
 */
function destory()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'phpchatroom'];// chatroom id
    $result = $RongSDK->getChatroom()->destory($chatroom);
    Utils::dump("销毁聊天室",$result);
}
destory();

/**
 * // Check if the user is in the chat room
 */
function isExist()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'php chatroom',// // Chat room ID
        'members'=>[
            ['id'=>"sea9902"]// // @param personnel id
        ]
    ];
    $result = $RongSDK->getChatroom()->isExist($chatroom);
    Utils::dump("检查用户是否在聊天室",$result);
}
isExist();
