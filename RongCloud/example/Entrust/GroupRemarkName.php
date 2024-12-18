<?php

/**
 * 群组信息托管-备注名模块测试
 */
require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * 设置用户指定群组名称备注名
 */
function remarkNameSet()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222',
        'remarkName' => 'rongcloud'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->set($param);
    Utils::dump("设置用户指定群组名称备注名", $result);
}
remarkNameSet();

/**
 * 设置用户指定群组名称备注名
 */
function remarkNameDelete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("设置用户指定群组名称备注名", $result);
}
remarkNameDelete();

/**
 * 查询用户指定群组名称备注名
 */
function remarkNameQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("查询用户指定群组名称备注名", $result);
}
remarkNameQuery();




