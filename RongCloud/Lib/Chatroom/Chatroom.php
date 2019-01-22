<?php
/**
 * 聊天室
 */
namespace RongCloud\Lib\Chatroom;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;
use RongCloud\Lib\Chatroom\Ban\Ban;
use RongCloud\Lib\Chatroom\Block\Block;
use RongCloud\Lib\Chatroom\Demotion\Demotion;
use RongCloud\Lib\Chatroom\Distribute\Distribute;
use RongCloud\Lib\Chatroom\Gag\Gag;
use RongCloud\Lib\Chatroom\Keepalive\Keepalive;
use RongCloud\Lib\Chatroom\Whitelist\Whitelist;
use RongCloud\Lib\Chatroom\Whitelist\Message;

class Chatroom
{
    /**
     * 聊天室模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/';

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
     * Chatroom constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }


    /**
     * 聊天室创建
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',//聊天室 id
            'name'=> 'RongCloud',//聊天室名称
         ];
     * @return mixed|null
     */
    public function create(array $Chatroom=[]){
        if(!isset($Chatroom[0])){
            $Chatroom = [$Chatroom];
        }
        $conf = $this->conf['create'];
        $verify = $this->verify['chatroom'];
        $verify = ['id'=>$verify['id'],'name'=>$verify['name']];
        $data = [];
        foreach ($Chatroom as $v){
            $error = (new Utils())->check([
                'api'=> $conf,
                'model'=> 'chatroom',
                'data'=> $v,
                'verify'=> $verify
            ]);
            if($error) return $error;
            $data[$v['id']] = $v['name'];
        }
        $result = (new Request())->Request($conf['url'],$data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 销毁聊天室
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',//聊天室 id
        ];
     * @return mixed|null
     */
    public function destory(array $Chatroom=[]){
        $conf = $this->conf['destory'];
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
            'id'=> 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取聊天室信息
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',//聊天室 Id
            'count'=>10,//聊天室成员信息数，最多返回 500 个成员
            'order'=>2//查询聊天室成员顺序， 1: 加入时间正序 2: 加入时间倒序
        ];
     * @return mixed|null
     */
    public function get(array $Chatroom=[]){
        $conf = $this->conf['get'];
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
            'id'=> 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 检查用户是否在聊天室
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',//聊天室 id
            'members'=>[
                ['id'=>"sea9902"]//人员id
            ]
        ];
     * @return mixed|null
     */
    public function isExist(array $Chatroom=[]){
        $conf = $this->conf['isExist'];
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
            'id'=> 'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['result'=>'members']);
            foreach ($result['members'] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

    /**
     * 创建聊天室全局禁言对象
     *
     * @return Ban
     */
    public function Ban(){
        return new Ban();
    }

    /**
     * 创建聊天室封禁对象
     *
     * @return Block
     */
    public function Block(){
        return new Block();
    }

    /**
     * 创建聊天室消息降级对象
     *
     * @return Demotion
     */
    public function Demotion(){
        return new Demotion();
    }

    /**
     * 创建聊天室消息分发对象
     *
     * @return Distribute
     */
    public function Distribute(){
        return new Distribute();
    }

    /**
     * 创建聊天室成员禁言对象
     *
     * @return Gag
     */
    public function Gag(){
        return new Gag();
    }

    /**
     * 创建聊天室包活对象
     *
     * @return Keepalive
     */
    public function Keepalive(){
        return new Keepalive();
    }

    /**
     * 创建聊天室用户白名单对象
     *
     * @return Whitelist
     */
    public function Whitelist(){
        return new Whitelist();
    }

    /**
     * 创建聊天室白名单消息对象
     *
     * @return Message
     */
    public function Message(){
        return new Message();
    }

}