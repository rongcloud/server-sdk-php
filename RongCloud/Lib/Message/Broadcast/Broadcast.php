<?php
/**
 * 广播消息
 */
namespace RongCloud\Lib\Message\Broadcast;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Broadcast {

    /**
     * @var string 广播消息路径
     */
    private $jsonPath = 'Lib/Message/Broadcast/';

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
     * System constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * @param $Message array 广播消息撤回
     * @param
            $message = [
                'senderId'=> 'test',//发送人 id
                "objectName"=>'RC:RcCmd',//消息类型
                'content'=>[
                    'uId'=>'xxxxx',//消息唯一标识，通过 /push 发送广播消息后获取，返回名称为 id。
                    'type'=>'SYSTEM',//系统会话
                    'isAdmin'=>'0',//是否为管理员，默认为 0；设为 1 时 IMKit SDK 收到此条消息后，小灰条默认显示为“管理员 撤加了一条消息”
                    'isDelete'=>0]//是否删除消息，默认为 0 撤回该条消息同时，用户端将该条消息删除并替换为一条小灰条撤回提示消息；为 1 时，该条消息删除后，不替换为小灰条提示消息。
            ];
     * @return array
     */
    public function recall(array $Message=[]){
        $conf = $this->conf['broadcast'];
        $verify = $this->verify['broadcast'];
        if(isset($verify['targetId'])){
            unset($verify['targetId']);
        }
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];
        $content = $Message['content'];
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $content = (new Utils())->rename($content , [
            'uId'=>'messageUId'
        ]);
        $content['conversationType'] = 6;
        $Message['content'] = json_encode($content);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

}