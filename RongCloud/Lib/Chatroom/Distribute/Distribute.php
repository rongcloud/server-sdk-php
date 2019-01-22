<?php
/**
 * 聊天室消息分发
 */
namespace RongCloud\Lib\Chatroom\Distribute;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

class Distribute {

    /**
     * 停止聊天室消息分发路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Chatroom/Distribute/';

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
     * Distribute constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
     * 停止聊天室消息分发
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'ujadk90ha',//聊天室 id
        ];
     * @return mixed|null
     */
    public function stop(array $Chatroom=[]){
        $conf = $this->conf['stop'];
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
     * 恢复聊天室消息分发
     *
     * @param array $Chatroom
     * $Chatroom = [
            'id'=> 'ujadk90ha',//聊天室 id
        ];
     * @return mixed|null
     */
    public function resume(array $Chatroom=[]){
        $conf = $this->conf['resume'];
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

}