<?php
/**
 * 聊天室保活
 */
namespace RongCloud\Lib\Chatroom\Keepalive;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Keepalive {

    /**
     * 聊天室保活路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/Keepalive/';

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
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 添加保活聊天室
     *
     * @param $Chatroom
     * $Chatroom = [
            'id'=> 'ujadk90ha',//聊天室 id
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
            'id'=>'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 删除保活聊天室
     *
     * @param $Chatroom
     * $Chatroom = [
            'id'=> 'ujadk90ha',//聊天室 id
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
            'id'=>'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 获取保活聊天室
     *
     * @param $Chatroom
     * $Chatroom = [

        ];
     * @return mixed|null
     */
    public function getList(array $Chatroom=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200 || $result['code'] == 0){
            $result = (new Utils())->rename($result,['chatroomIds'=>'chatrooms']);
            $result['code'] = 200;
        }
        return $result;
    }
}