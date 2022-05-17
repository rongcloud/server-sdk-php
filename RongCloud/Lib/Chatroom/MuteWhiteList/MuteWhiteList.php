<?php
/**
 * 聊天室全体禁言
 */
namespace RongCloud\Lib\Chatroom\MuteWhiteList;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class MuteWhiteList {

    /**
     * 聊天室全体禁言路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/MuteWhiteList/';

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
     * MuteWhiteList constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加聊天室全体禁言白名单
     *
     * @param array $Chatroom
     * $Chatroom = [
            'members'=> [
                ['id'=>'seal9901']//人员 id
            ],
            'id'=>"chatroomId"//聊天室id
        ];
     * @return mixed|null
     */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members'],'id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Chatroom['members'] as &$v){
            $v = $v['id'];
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'members'=>'userId',
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 移除聊天室全体禁言人员
     *
     * @param array $Chatroom
     * $Chatroom = [
            'members'=> [
                ['id'=>'seal9901']//成员 id
            ],
           'id'=>"chatroomId"//聊天室id
        ];
     * @return mixed|null
     */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['members'=>$verify['members'],"id"=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Chatroom['members'] as &$v){
            $v = $v['id'];
        }
        $Chatroom = (new Utils())->rename($Chatroom, [
            'members'=>'userId',
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取聊天室全体禁言白名单列表
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=>"chatroomId"//聊天室id
        ];
     * @return mixed|null
     */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $verify = $this->verify['chatroom'] ;
        $verify = ["id"=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id'=>"chatroomId"
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}