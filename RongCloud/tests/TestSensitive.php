<?php
/**
 * // Test cases for sensitive word module
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
        'replace'=> '***',// // Sensitive word replacement, maximum length not exceeding 32 characters, sensitive word masking can be empty
        'keyword'=>"abc",// Sensitive word
        'type'=>0// 0: Sensitive word substitution 1: Sensitive word filtering
    ];
    Utils::dump("添加敏感词成功",$Sensitive->add($params));

    Utils::dump("添加敏感词 keyword 错误",$Sensitive->add());


    $params = [
        'words' => [
            [
                'word' => "abc1", // // Screen masking
            ],
            [
                'word' => "abc2", // // Sensitive word
                'replaceWord' => '***' // // Sensitive word replacement, maximum length does not exceed 32 characters, sensitive word masking can be empty
            ]
        ]
    ];
    Utils::dump("批量添加敏感词成功",$Sensitive->batchAdd($params));

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


