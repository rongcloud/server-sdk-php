<?php
/**
 * 聊天室全体禁言
 */
namespace RongCloud\Lib\Chatroom\MuteAllMembers;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class MuteAllMembers {

    /**
     * 聊天室全体禁言路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/MuteAllMembers/';

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
     * MuteAllMembers constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加聊天室全体禁言
     *
     * @param array $Chatroom
     * $Chatroom = [
                ['id'=>'seal9901']//聊天室 id
        ];
     * @return mixed|null
     */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 移除全体禁言
     *
     * @param array $Chatroom
     * $Chatroom = [
            ['id'=>'seal9901']//聊天室 id
        ];
     * @return mixed|null
     */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
    /**
     * 全体禁言状态检查
     *
     * @param array $Chatroom
     * $Chatroom = [
            ['id'=>'seal9901']//聊天室 id
    ];
     * @return mixed|null
     */
    public function check(array $Chatroom=[]){
        $conf = $this->conf['check'];
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
            'id'=>'chatroomId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取聊天室全体禁言状态列表
     *
     * @param array $Chatroom
     * $Chatroom = [

        ];
     * @return mixed|null
     */
    public function getList($page = 1, $size = 50){
        $conf = $this->conf['getList'];
        $Chatroom = ["page"=>$page, "size"=>$size];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}