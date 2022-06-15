<?php
/**
 * 超级群频道实例
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 超级群频道创建
 */
function create()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'phpgroup1',//超级群 id
        'busChannel'=> 'busChannel',//超级群频道
    ];
    $result = $RongSDK->getUltragroup()->BusChannel()->add($group);
    Utils::dump("超级群频道创建",$result);
}
create();
/**
 * 超级群频道获取
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $result = $RongSDK->getUltragroup()->BusChannel()->getList("phpgroup1");
    Utils::dump("超级群频道列表",$result);
}
getList();
/**
 * 超级群频道删除
 */
function remove()
{

     $RongSDK = new RongCloud(APPKEY,APPSECRET);
        $group = [
            'id'=> 'phpgroup1',//超级群 id
            'busChannel'=> 'busChannel',//超级群频道
        ];
        $result = $RongSDK->getUltragroup()->BusChannel()->remove($group);
    Utils::dump("超级群频道删除",$result);echo 3333;
}
remove();


getList();