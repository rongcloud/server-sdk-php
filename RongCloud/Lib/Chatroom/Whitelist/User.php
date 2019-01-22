<?php
/**
 * 聊天室用户白名单
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class User {

    /**
     * 聊天室白名单用户模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/Whitelist/';

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
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'user-api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加聊天室用户白名单
     *
     * @param $Chatroom
     * $Chatroom = [
            'id'=> "chatroom1",//聊天室 id
             'members'=>['abc','abcd']//用户列表
        ]
     * @return array
     */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members']];
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
            'id'=>'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 移除聊天室用户白名单
     *
     * @param $Chatroom
     * $Chatroom = [
            'id'=> "chatroom1",//聊天室 id
            'members'=>['abc','abcd']//用户列表
     ]
     * @return array
     */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members']];
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
            'id'=>'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取聊天室用户白名单
     *
     * @param $Chatroom
     * $Chatroom = [

    ]
     * @return array
     */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'id'=>'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members'] as $k=>$v){
                $result['members'][$k] = ['id'=>$v];
            }

        }
        return $result;
    }
}