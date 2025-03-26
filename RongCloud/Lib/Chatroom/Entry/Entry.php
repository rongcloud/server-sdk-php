<?php
/**
 * Chat room attributes
 */

namespace RongCloud\Lib\Chatroom\Entry;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Entry {

    /**
 * Chat room attribute path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Entry/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Validate configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Keepalive constructor.
 */
    function __construct() {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
 * Set chatroom properties (KV)
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=>       'ujadk90ha',//  Chatroom id
 * 'userId'=>   'ujadk90ha',//  Operator user Id
 * 'key'=>      'ujadk90ha',//  Chatroom property name
 * 'value'=>    'ujadk90ha',//  Corresponding value of the chatroom property
 * ];
 * @return mixed|null
 */
    public function set(array $Chatroom = []) {
        $conf = $this->conf['set'];
        $verify = $this->verify['chatroom'];
        $verify = ['id' => $verify['id']];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'chatroom',
                'data' => $Chatroom,
                'verify' => $verify
            ]
        );
        if ($error) {
            return $error;
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id' => 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'], $Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Batch set chatroom properties (KV)
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=>       'ujadk90ha',      // Chatroom ID
 * 'autoDelete'=> 0,              // Whether to delete this Key value after the user (entryOwnerId) exits the chatroom
 * 'entryOwnerId'=> 'test',       // The user ID to whom the chatroom's custom properties belong
 * 'entryInfo'=> '{"key1":"value1","key2":"value2"}',//  The value corresponding to the chatroom properties
 * ];
 * @return mixed|null
 */
    public function batchSet(array $Chatroom = []) {
        $conf = $this->conf['batchset'];
        $verify = $this->verify['chatroom'];
        $verify = ['id' => $verify['id']];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'chatroom',
                'data' => $Chatroom,
                'verify' => $verify
            ]
        );
        if ($error) {
            return $error;
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id' => 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'], $Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get chatroom properties
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=>       'ujadk90ha',//Chatroom id
 * 'userId'=>   'ujadk90ha',//Operator user Id
 * 'key'=>      'ujadk90ha',//Chatroom property name
 * ];
 * @return mixed|null
 */
    public function remove(array $Chatroom = []) {
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'];
        $verify = ['id' => $verify['id']];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'chatroom',
                'data' => $Chatroom,
                'verify' => $verify
            ]
        );
        if ($error) {
            return $error;
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id' => 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'], $Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get chatroom properties
 *
 * @param $Chatroom
 * $Chatroom = [
 * 'id'=>       'ujadk90ha',//Chatroom ID
 * 'keys'=>   'ujadk90ha',//Operator user ID
 * ]
 * @return array
 */
    public function query(array $Chatroom = []) {
        $conf = $this->conf['query'];
        $verify = $this->verify['chatroom'];
        $verify = ['id' => $verify['id']];
        $error = (new Utils())->check(
            [
                'api' => $conf,
                'model' => 'chatroom',
                'data' => $Chatroom,
                'verify' => $verify
            ]);
        if ($error) {
            return $error;
        }
        if (isset($Chatroom['keys']) && count($Chatroom['keys']) > 0) {
            foreach ($Chatroom['keys'] as &$v) {
                $v = $v['key'];
            }
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id' => 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'], $Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if ($result['code'] == 200) {
            foreach ($result['keys'] as $k => $v) {
                $result['keys'][$k] = ['key' => $v];
            }
        }
        return $result;
    }
}