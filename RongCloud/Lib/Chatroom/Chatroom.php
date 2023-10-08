<?php
/**
 * 聊天室
 */
namespace RongCloud\Lib\Chatroom;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
use RongCloud\Lib\Chatroom\Ban\Ban;
use RongCloud\Lib\Chatroom\Block\Block;
use RongCloud\Lib\Chatroom\Demotion\Demotion;
use RongCloud\Lib\Chatroom\Distribute\Distribute;
use RongCloud\Lib\Chatroom\Gag\Gag;
use RongCloud\Lib\Chatroom\Keepalive\Keepalive;
use RongCloud\Lib\Chatroom\Whitelist\Whitelist;
use RongCloud\Lib\Chatroom\Whitelist\Message;
use RongCloud\Lib\Chatroom\Entry\Entry;
use RongCloud\Lib\Chatroom\MuteAllMembers\MuteAllMembers;
use RongCloud\Lib\Chatroom\MuteWhiteList\MuteWhiteList;

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
     * @deprecated 已弃用，请使用 createV2 的方法进行创建
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
            $data["chatroom[{$v['id']}]"] = $v['name'];
        }
        $result = (new Request())->Request($conf['url'],$data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 聊天室创建
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',//聊天室 id
            'destroyType' => 0, //指定聊天室的销毁类型 0：默认值，表示不活跃时销毁,1：固定时间销毁
            'destroyTime' => 60, //设置聊天室销毁时间
            'isBan' => false, //是否禁言聊天室全体成员，默认 false
            'whiteUserIds' => ['user1','user2'], //禁言白名单用户列表，支持批量设置，最多不超过 20 个
            'entryOwnerId' => '', //聊天室自定义属性的所属用户 ID。
            'entryInfo' => '', //聊天室自定义属性 KV 对，JSON 结构。
         ];
     * @return mixed|null
     */
    public function createV2(array $Chatroom=[]){
        $conf = $this->conf['createV2'];
        $verify = $this->verify['chatroom'];
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
        $result = (new Request())->Request($conf['url'], $Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 设置聊天室销毁类型
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'chatroom9992',  //聊天室 id
            'destroyType'=> 0,      //指定聊天室的销毁方式。
            'destroyTime'=> 60      //设置聊天室销毁时间。
        ];
     * @return mixed|null
     */
    public function setDestroyType(array $Chatroom=[]){
        $conf = $this->conf['setDestroyType'];
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
     * 查询聊天室基础信息
     *
     * @DateTime 2023-06-14
     * @deprecated 已弃用，请使用 queryV2 的方法进行创建
     * @param array $Chatroom ['id'=> ['chatroom1','chatroom1','chatroom1']]
     * 
     * @return array
     */
    public function query(array $Chatroom=[]){
        $conf = $this->conf['query'];
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
     * 查询聊天室基础信息V2
     *
     * @DateTime 2023-10-08
     * @param array $Chatroom ['id'=> ['chatroom1','chatroom1','chatroom1']]
     * 
     * @return array
     */
    public function queryV2(array $Chatroom=[]){
        $conf = $this->conf['queryV2'];
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
     * 获取聊天室成员
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
     * @return MuteWhiteList
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

    /**
     * 创建聊天室白名单消息对象
     *
     * @return Entry
     */
    public function Entry(){
        return new Entry();
    }

    /**
     * 聊天室全体禁言
     *
     * @return MuteAllMembers
     */
    public function MuteAllMembers(){
        return new MuteAllMembers();
    }

    /**
     * 聊天室全体禁言白名单
     *
     * @return MuteWhiteList
     */
    public function MuteWhiteList(){
        return new MuteWhiteList();
    }
}