<?php
/**
 * Chat room ban
 */
namespace RongCloud\Lib\Chatroom\Block;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Block {

    /**
 * Chat room ban path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/Block/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Configuration file for validation
 *
 * @var string
 */
    private $verify = '';

    /**
 * Block constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');;
    }

    /**
 *  Add ban
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha', // Chatroom ID
 * 'members'=> [
 * ['id'=>'seal9901'] // Banned member ID
 * ],
 * 'minute'=>30 // Ban duration in minutes
 * ];
 * @return mixed|null
 */
    public function add(array $Chatroom=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['chatroom'] ;
        $verify = ['id'=>$verify['id'],'members'=>$verify['members'],'minute'=>$verify['minute']];
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
        return $result;
    }

    /**
 * Unblock
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'ujadk90ha',//Chatroom ID
 * 'members'=> [
 * ['id'=>'seal9901']//Unblocked member ID
 * ],
 * ];
 * @return mixed|null
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
            'id'=> 'chatroomId',
            'members'=>'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of banned members
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',//chatroom id
 * ];
 * @return mixed|null
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
            'id'=> 'chatroomId',
        ]);
        $result = (new Request())->Request($conf['url'],$Chatroom);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members'] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }
}