<?php
/**
 * 聊天室人员封禁
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 添加封禁
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'OIBbeKlkx',//聊天室 id
        'members'=> [
            ['id'=>'aP9uvganV']//封禁成员 id
        ],
        'minute'=>500//封禁时长
    ];
    $Block = $RongSDK->getChatroom()->Block()->add($chatroom);
    Utils::dump("添加封禁",$Block);
}
add();

/**
 * 解除封禁
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'OIBbeKlkx',//聊天室 id
        'members'=> [
            ['id'=>'aP9uvganV']//解除封禁成员 id
        ],
    ];
    $Block = $RongSDK->getChatroom()->Block()->remove($chatroom);
    Utils::dump("解除封禁",$Block);
}
remove();

/**
 * 查询被封禁成员列表
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=>'OIBbeKlkx'//聊天室 id
    ];
    $Block = $RongSDK->getChatroom()->Block()->getList($chatroom);
    Utils::dump("查询被封禁成员列表",$Block);
}
getList();