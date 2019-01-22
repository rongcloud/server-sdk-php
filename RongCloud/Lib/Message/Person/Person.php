<?php
/**
 * 二人消息
 */
namespace RongCloud\Lib\Message\Person;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Person {

    /**
     * @var string 二人消息路径
     */
    private $jsonPath = 'Lib/Message/Person/';

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
     * Person constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * @param $Message array 二人消息发送
     * @param
     * $Message = [
            'senderId'=> 'ujadk90ha',//发送人 id
            'targetId'=> 'markoiwm',//接收人 id
            "objectName"=>'RC:TxtMsg',//消息类型 文本
            'content'=>['content'=>'你好，小明']//消息体
        ];
     * @return array
     */
    public function send(array $Message=[]){
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
            'targetId'=> 'toUserId'
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 向多个用户发送不同内容消息
     * @param
     * $Message = [
            'senderId'=> 'kamdnq',//发送人 id
            'objectName'=>'RC:TxtMsg',//消息类型 文本
            'template'=>['content'=>'{name}, 语文成绩 {score} 分'],//模板内容
            'content'=>[
                'sea9901'=>[//接收人 id
                    'data'=>['{name}'=>'小明','{score}'=>'90'],//模板数据
                    'push'=>'{name} 你的成绩出来了',//推送内容
                ],
                'sea9902'=>[//接收人 id
                    'data'=>['{name}'=>'小红','{score}'=>'95'],//模板数据
                    'push'=>'{name} 你的成绩出来了',//推送内容
                ]
            ]
     ];
     * @return array
     */
    public function sendTemplate(array $Message=[]){
        $conf = $this->conf['sendTemplate'];
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
        $newMessage = [
            'fromUserId'=>$Message['fromUserId'],
            'objectName'=>$Message['objectName'],
            "content"=>$Message['template'],
        ];
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];
        foreach ($Message['content'] as $userId=>$v){
            $newMessage['toUserId'][] = $userId;
            $newMessage['values'][] = $v['data'];
            $newMessage['pushData'][] = isset($v['pushData'])?$v['pushData']:'';
            $newMessage['pushContent'][] = $v['push'];
        }

        $result = (new Request())->Request($conf['url'],$newMessage,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 二人消息撤回
     * @param
     * $Message = [
            'senderId'=> 'ujadk90ha',//发送人 id
            'targetId'=> 'markoiwm',//接收人 id
            "uId"=>'5GSB-RPM1-KP8H-9JHF',//消息唯一标识
            'sentTime'=>'1519444243981'//发送时间
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
            'uId'=>'messageUID'
        ]);
        $Message['conversationType'] = ConversationType::t()['PRIVATE'];
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}