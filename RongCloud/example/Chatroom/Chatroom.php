<?php
/**
 * 聊天室
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 创建聊天室
 */
function create()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        ['id'=> 'phpchatroom4',//聊天室 id
        'name'=> 'phpchatroom1']//聊天室 name
    ];
    $result = $RongSDK->getChatroom()->create($chatroom);
    Utils::dump("创建聊天室",$result);
}
create();



/**
 * 获取聊天室信息
 */
function get()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
                'id'=> 'phpchatroom4',//聊天室 id
                'count'=>10,
                'order'=>1
                ];
    $result = $RongSDK->getChatroom()->get($chatroom);
    Utils::dump("获取聊天室信息",$result);
}
get();

/**
 * 销毁聊天室
 */
function destory()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'phpchatroom'];//聊天室 id
    $result = $RongSDK->getChatroom()->destory($chatroom);
    Utils::dump("销毁聊天室",$result);
}
destory();
/**
 * 检查用户是否在聊天室
 */
function isExist()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'php chatroom',//聊天室 id
        'members'=>[
            ['id'=>"sea9902"]//人员id
        ]
    ];
    $result = $RongSDK->getChatroom()->isExist($chatroom);
    Utils::dump("检查用户是否在聊天室",$result);
}
isExist();
