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
 * 创建聊天室V2
 */
function createV2()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'phpchatroom4',  //聊天室 id
        'destroyType'=> 0,      //指定聊天室的销毁类型 0：默认值，表示不活跃时销毁,1：固定时间销毁
        'isBan' => true,        //是否禁言聊天室全体成员，默认 false
        'whiteUserIds' => ['user1','user2'] //禁言白名单用户列表，支持批量设置，最多不超过 20 个
    ];
    $result = $RongSDK->getChatroom()->createV2($chatroom);
    Utils::dump("创建聊天室V2",$result);
}
createV2();

/**
 * 查询聊天室基础信息
 */
function query()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
                'id'=> ['aaa','bbb','ccc'],//聊天室 id
                ];
    $result = $RongSDK->getChatroom()->query($chatroom);
    Utils::dump("查询聊天室基础信息",$result);
}
query();

/**
 * 查询聊天室基础信息V2
 */
function queryV2()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'aaa'];//聊天室 id
    $result = $RongSDK->getChatroom()->queryV2($chatroom);
    Utils::dump("查询聊天室基础信息V2",$result);
}
queryV2();

/**
 * 获取聊天室成员
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
    Utils::dump("获取聊天室成员",$result);
}
get();

/**
 * 设置聊天室销毁类型
 */
function setDestroyType()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = ['id'=> 'phpchatroom','destroyType'=> 0,'destroyTime'=> 60];//聊天室 id
    $result = $RongSDK->getChatroom()->setDestroyType($chatroom);
    Utils::dump("设置聊天室销毁类型",$result);
}
setDestroyType();

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
