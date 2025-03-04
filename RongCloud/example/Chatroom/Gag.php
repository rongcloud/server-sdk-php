<?php
/**
 * Chatroom member banned speech
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add chat room member mute
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'chatroom001',// Chat room id
        'members'=> [
            ['id'=>'seal9901']// Forbidden personnel id
        ],
        'minute'=>30// Forbidden utterance duration
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->add($chatroom);
    Utils::dump("Add chat room member ban.",$Gag);
}
add();

/**
 * Unban chat room member
 */
function remove()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        'id'=> 'ujadk90ha',// Chat room id
        'members'=> [
            ['id'=>'seal9901']// Personnel ID
        ],
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->remove($chatroom);
    Utils::dump("Unban chatroom member",$Gag);
}
remove();

/**
 * Get the list of muted members in the chat room
 */
function getList()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $chatroom = [
        "id"=>"chatroom001"// chatroom id
    ];
    $Gag = $RongSDK->getChatroom()->Gag()->getList($chatroom);
    Utils::dump("Get the list of banned words in the chat room",$Gag);
}
getList();