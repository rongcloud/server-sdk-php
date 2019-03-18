<?php
/**
 * 聊天室模块 用户白名单实例
 */


require "./../../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加聊天室用户白名单
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",//聊天室 id
        "members"=>[
            ["id"=>"user1"], //用户 id
            ["id"=>"user2"]
        ]
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->add($chatroom);
    Utils::dump("添加聊天室用户白名单",$User);
}
add();

/**
 * 移除聊天室用户白名单
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",//聊天室 id
        "members"=>[
           ["id"=>"user4"], //用户 id
           ["id"=>"user5"]
        ]
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->remove($chatroom);
    Utils::dump("移除聊天室用户白名单",$User);
}
remove();

/**
 * 获取聊天室用户白名单
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"seal9901",//聊天室 id
    ];
    $User = $RongSDK->getChatroom()->Whitelist()->User()->getList($chatroom);
    Utils::dump("获取聊天室用户白名单",$User);
}
getList();