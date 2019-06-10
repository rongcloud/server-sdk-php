<?php
/**
 * 推送实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define("APPSECRET", '');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 广播消息
 */
function broadcast()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $sensitive = [
        'platform'=> ['ios','android'],//目标操作系统
        'fromuserid'=>'mka091amn',//送人用户 Id
        'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
        'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],//发送消息内容
        'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]
    ];
    $result = $RongSDK->getPush()->broadcast($sensitive);
    Utils::dump("广播消息",$result);
}
broadcast();

/**
 * 推送消息
 */
function push()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $sensitive = [
        'platform'=> ['ios','android'],//目标操作系统
        'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
        'notification'=>['alert'=>"this is a push"]
    ];
    $result = $RongSDK->getPush()->push($sensitive);
    Utils::dump("推送消息",$result);
}
push();

