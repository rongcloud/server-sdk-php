<?php
/**
 * 聊天室消息降级
 */
namespace RongCloud\Lib\Chatroom\Demotion;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Demotion {

    /**
     * 聊天室成消息降级路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/Demotion/';

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
     * Demotion constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加应用内聊天室降级消息
     *
     * @param array $Chatroom
     * $Chatroom = [
                'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// 消息类型列表
        ];
     * @return mixed|null
     */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'demotion',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectName',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 移除应用内聊天室降级消息
     *
     * @param array $Chatroom
     * $Chatroom = [
            'msgs'=> ['RC:TxtMsg03','RC:TxtMsg02']// 消息类型列表
        ];
     * @return mixed|null
     */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'demotion',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectName',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取应用内聊天室降级消息
     *
     * @param array $Chatroom
     * $Chatroom = [

        ];
     * @return mixed|null
     */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}