<?php
/**
 * Test cases for sensitive word module
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
        'replace'=> '***',// Sensitive word replacement, maximum length not exceeding 32 characters, sensitive word masking can be empty
        'keyword'=>"abc",// Sensitive word
        'type'=>0// 0: Sensitive word substitution 1: Sensitive word filtering
    ];
    Utils::dump("Add sensitive word successfully",$Sensitive->add($params));

    Utils::dump("Add sensitive keyword error",$Sensitive->add());


    $params = [
        'words' => [
            [
                'word' => "abc1",//  Screen masking
            ],
            [
                'word' => "abc2",//  Sensitive word
                'replaceWord' => '***'//  Sensitive word replacement, maximum length does not exceed 32 characters, sensitive word masking can be empty
            ]
        ]
    ];
    Utils::dump("Batch addition of sensitive words successful",$Sensitive->batchAdd($params));

    $params = [
        'keywords'=>["bbb"]
    ];
    Utils::dump("Delete sensitive words successfully",$Sensitive->remove($params));

    $params = [
        'keywords'=>[]
    ];
    Utils::dump("Delete sensitive keywords error",$Sensitive->remove($params));

    $params = [
        'type'=>0
    ];
    Utils::dump("Get sensitive word success",$Sensitive->getList($params));

}
testSensitive($RongSDK);


