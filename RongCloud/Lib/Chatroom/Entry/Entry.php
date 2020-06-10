<?php
/**
 * 聊天室属性
 */

namespace RongCloud\Lib\Chatroom\Entry;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Entry {

    /**
     * 聊天室属性路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/Entry/';

    /**
     * 请求配置文件
     *
     * @var string
     */
    private $conf = "";

    /**
     * 校验配置文件
     *
     * @var string
     */
    private $verify = "";

    /**
     * Keepalive constructor.
     */
    function __construct() {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
     * 删除聊天室属性
     *
     * @param $Chatroom
     * $Chatroom = [
     * 'id'=>       'ujadk90ha',//聊天室 id
     * 'userId'=>   'ujadk90ha',//操作用户 Id
     * 'key'=>      'ujadk90ha',//聊天室属性名称
     * 'value'=>    'ujadk90ha',//聊天室属性对应的值
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
     * 获取聊天室属性
     *
     * @param $Chatroom
     * $Chatroom = [
     * 'id'=>       'ujadk90ha',//聊天室 id
     * 'userId'=>   'ujadk90ha',//操作用户 Id
     * 'key'=>      'ujadk90ha',//聊天室属性名称
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
     * 获取聊天室属性
     *
     * @param $Chatroom
     * $Chatroom = [
     * 'id'=>       'ujadk90ha',//聊天室 id
     * 'keys'=>   'ujadk90ha',//操作用户 Id
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