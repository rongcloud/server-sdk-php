<?php

/**
 * Sensitive word example
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET', '');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add sensitive words
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $sensitive = [
        'replace' => '***',//  Sensitive word replacement, maximum length not exceeding 32 characters, sensitive word filtering can be empty
        'keyword' => "abc",//  Sensitive word
        'type' => 0//  0: Sensitive word substitution 1: Sensitive word filtering
    ];
    $result = $RongSDK->getSensitive()->add($sensitive);
    Utils::dump("Add sensitive words", $result);
}
add();

function batchAdd()
{
    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $sensitive = [
        'words' => [
            [
                'word' => "abc1",//  Screen
            ],
            [
                'word' => "abc2",//  Sensitive words
                'replaceWord' => '***'//  Sensitive word replacement, maximum length not exceeding 32 characters, sensitive word screening can be empty
            ]
        ]
    ];
    $result = $RongSDK->getSensitive()->batchAdd($sensitive);
    Utils::dump("batchAdd", $result);
}
batchAdd();

/**
 * Remove sensitive words
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $sensitive = [
        'keywords' => ["cccccdddd"]//  Delete sensitive words
    ];
    $result = $RongSDK->getSensitive()->remove($sensitive);
    Utils::dump("Remove sensitive words", $result);
}
remove();

/**
 * Get the list of sensitive words
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY, APPSECRET);
    $sensitive = [
        'type' => '',//  Sensitive word type, 0: Sensitive word replacement, 1: Sensitive word shielding, empty to retrieve all
    ];
    $result = $RongSDK->getSensitive()->getList($sensitive);
    Utils::dump("Get the list of sensitive words", $result);
}
getList();
