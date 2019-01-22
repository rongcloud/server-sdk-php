<?php
/**
 * 讨论组消息
 */
namespace RongCloud\Lib\Message\Discussion;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Discussion {
    private $jsonPath = 'Lib/Message/Discussion/';

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
     * Discussion constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * @param $Message array 讨论组消息发送
     * @param
     * $Message = [
                'senderId'=> 'ujadk90ha',//发送人 id
                'targetId'=> ['kkj9o01'],//讨论组，多个 id
                "objectName"=>'RC:TxtMsg',//消息类型 文本
                'content'=>json_encode(['content'=>'你好，主播'])//消息体
            ];
     * @return array
     */
    public function send($Message){
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toChatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 讨论组广播消息
     * @param
     * $Message = [
                'senderId'=> 'ujadk90ha',//发送人 id
                "objectName"=>'RC:TxtMsg',//消息类型 文本
                'content'=>json_encode(['content'=>'你好，主播']) //消息体
        ];
     * @return array
     */
    public function broadcast($Message){
        $conf = $this->conf['broadcast'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}