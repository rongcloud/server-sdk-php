<?php
/**
 * 群组消息
 */
namespace RongCloud\Lib\Message\Group;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Group {
    private $jsonPath = 'Lib/Message/Group/';

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
     * Group constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * @param $Message array 群组消息发送
     * @param
     * $Message = [
                'senderId'=> 'ujadk90ha',//发送人 id
                'targetId'=> 'markoiwm',//群组 id
                "objectName"=>'RC:TxtMsg',//消息类型 文本
                'content'=>['content'=>'你好，小明']//消息体
        ];
     * @return array
     */
    public function send(array $Message=[]){
        $conf = $this->conf['send'];
        if(isset($Message['content']) && is_array($Message['content'])){
            $Message['content'] = json_encode($Message['content']);
        }
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toGroupId'
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 群组消息 @
     * @param
     * $Message = [
                'senderId'=> 'ujadk90ha',//发送人 id
                'targetId'=> 'markoiwm',//群组 id
                "objectName"=>'RC:TxtMsg',//消息类型 文本
                'content'=>[//消息内容
                'content'=>'你好，小明',
                'mentionedInfo'=>[
                    'type'=>'1',//@ 功能类型，1 表示 @ 所有人、2 表示 @ 指定用户
                    'userIds'=>['kladd', 'almmn1'],//被 @ 人列表 type 为 2 时必填，type 为 1 时可以为空
                    'pushContent'=>'问候消息'//自定义 @ 消息 push 内容
                ]
            ];
     * @return array
     */
    public function sendMention(array $Message=[]){
        $conf = $this->conf['send'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];;
        $content = $Message['content'];
        $mentionedInfo = $content['mentionedInfo'];
        if($mentionedInfo){
            $Message['content']['mentionedInfo'] =  (new Utils())->rename($mentionedInfo, [
                'userIds'=> 'userIdList',
            ]);
        }
        $Message['content'] = json_encode($Message['content']);
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'targetId'=> 'toGroupId'
        ]);
        $Message['isMentioned'] = 1;
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 群组消息撤回
     * @param
     * $Message = [
                'senderId'=> 'ujadk90ha',//发送人 Id
                'targetId'=> 'markoiwm',//群组 Id
                "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息的唯一标识
                'sentTime'=>'1519444243981'//消息的发送时间
            ];
     * @return array
     */
    public function recall(array $Message=[]){
        $conf = $this->conf['recall'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
            'uId'=> 'messageUID'
        ]);
        $Message['conversationType'] = ConversationType::t()['GROUP'];
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}