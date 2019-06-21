<?php
/**
 * 敏感词模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testSensitive($RongSDK){
    $Sensitive = $RongSDK->getSensitive();
    $params = [
        'replace'=> '***',//敏感词替换，最长不超过 32 个字符， 敏感词屏蔽可以为空
        'keyword'=>"abc",//敏感词
        'type'=>0// 0: 敏感词替换 1: 敏感词屏蔽
    ];
    Utils::dump("添加敏感词成功",$Sensitive->add($params));

    Utils::dump("添加敏感词 keyword 错误",$Sensitive->add());

    $params = [
        'keywords'=>["bbb"]
    ];
    Utils::dump("删除敏感词成功",$Sensitive->remove($params));

    $params = [
        'keywords'=>[]
    ];
    Utils::dump("删除敏感词 keywords 错误",$Sensitive->remove($params));

    $params = [
        'type'=>0
    ];
    Utils::dump("获取敏感词成功",$Sensitive->getList($params));

}

testSensitive($RongSDK);


