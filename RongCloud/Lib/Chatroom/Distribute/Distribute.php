<?php
/**
 * Chat room message distribution
 */
namespace RongCloud\Lib\Chatroom\Distribute;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Distribute {

    /**
 * Stop the chat room message distribution path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Distribute/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Configuration file for verification
 *
 * @var string
 * Configuration file for verification
 *
 * @var string
 *
 */
    private $verify = '';

    /**
 * Distribute constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 * Stop chatroom message distribution
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//chatroom id
 * ];
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
 * Restore chatroom message distribution
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//chatroom id
 * ];
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