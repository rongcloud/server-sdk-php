<?php

/**
 * Group Information Hosting - Annotation Module Testing
 */
require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Set the user-specified group name remark
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
    Utils::dump("Set the user-specified group name remark", $result);
}
remarkNameSet();

/**
 * Set user-specified group name annotation
 */
function remarkNameDelete()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->delete($param);
    Utils::dump("Set user-specified group name annotation", $result);
}
remarkNameDelete();

/**
 * Query the specified group name for user remarks
 */
function remarkNameQuery()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $param = [
        'groupId' => 'RC_GROUP_1',
        'userId' => '222'
    ];
    $result = $RongSDK->getEntrust()->GroupRemarkName()->query($param);
    Utils::dump("Query the specified group name for user remarks", $result);
}
remarkNameQuery();




