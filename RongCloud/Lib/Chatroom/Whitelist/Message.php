<?php
/**
 * 聊天室消息白名单
 */
namespace RongCloud\Lib\Chatroom\Whitelist;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Message {

    /**
     * 聊天室消息白名单路径
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
     * Message constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'message-api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加聊天室消息白名单
     *
     * @param $Chatroom
     * $Chatroom = [
            'msgs'=> ["RC:TxtMsg"]//消息类型列表
         ]
     * @return array
     */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectnames',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 删除聊天室消息白名单
     *
     * @param $Chatroom
     * $Chatroom = [
            'msgs'=> ["RC:TxtMsg"]//消息类型列表
        ]
     * @return array
     */
    public function remove(array $Chatroom=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['demotion'] ;
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'chatroom',
            'data'=> $Chatroom,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Chatroom = (new Utils())->rename($Chatroom, [
            'msgs'=>'objectnames',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取聊天室消息白名单
     *
     * @param $Chatroom
     * $Chatroom = [

         ]
     * @return array
     */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['whitlistmsgType'=>'objectNames']);

        }
        return $result;
    }
}