<?php
/**
 * Chat room personnel ban
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'OIBbeKlkx',// Chat room id
        'members'=> [
            ['id'=>'aP9uvganV']// Ban member id
        ],
        'minute'=>500// Block duration
    ];
    $Block = $RongSDK->getChatroom()->Block()->add($chatroom);
    Utils::dump("Add ban",$Block);
}
add();

/**
 * Unblock
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'OIBbeKlkx',// Chat room ID
        'members'=> [
            ['id'=>'aP9uvganV']// Unblock member id
        ],
    ];
    $Block = $RongSDK->getChatroom()->Block()->remove($chatroom);
    Utils::dump("Unblock",$Block);
}
remove();

/**
 * Query the list of banned members
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=>'OIBbeKlkx'// @param chatroom id
    ];
    $Block = $RongSDK->getChatroom()->Block()->getList($chatroom);
    Utils::dump("Query the list of banned members",$Block);
}
getList();