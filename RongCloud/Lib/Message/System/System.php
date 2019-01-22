<?php
/**
 * 系统消息
 */
namespace RongCloud\Lib\Message\System;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class System {

    /**
     * @var string 系统消息路径
     */
    private $jsonPath = 'Lib/Message/System/';

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
     * @param $Message array 系统消息发送
     * @param
     * $Message = [
            'senderId'=> '__system__',//发送人 id
            'targetId'=> 'markoiwm',//接收放 id
            "objectName"=>'RC:TxtMsg',//消息类型 文本
            'content'=>['content'=>'你好，小明']//消息体
        ];
     * @return array
     */
    public function send(array $Message=[]){
        $conf = $this->conf['send'];
        if(isset($Message['content'])){
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
            'targetId'=> 'toUserId'
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 系统广播消息
     * @param
     * $Message = [
                'senderId'=> '__system__',//发送人 id
                "objectName"=>'RC:TxtMsg',//消息类型
                'content'=>['content'=>'你好，小明']//消息内容
        ];
     * @return array
     */
    public function broadcast(array $Message=[]){
        $conf = $this->conf['broadcast'];
        if(isset($Message['content'])){
            $Message['content'] = json_encode($Message['content']);
        }
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
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 系统模板消息
     * @param
     * $Message = [
                'senderId'=> '__system__',//发送人 id
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
            'verify'=> $this->verify['tplMsg']
        ]);
        if($error) return $error;
        $Message = (new Utils())->rename($Message, [
            'senderId'=> 'fromUserId',
        ]);
        $Message['content'] = isset($Message['content'])?json_decode($Message['content'],true):[];
        $newMessage = [
            'fromUserId'=>$Message['fromUserId'],
            'objectName'=>$Message['objectName'],
            "content"=>$Message['template'],
        ];
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

}