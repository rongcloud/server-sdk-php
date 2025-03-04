<?php
/**
 * Chatroom
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
 * Chat room module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Chatroom/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Validation configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Chatroom constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }


    /**
 * Chatroom Creation
 *
 * @deprecated Deprecated, please use the createV2 method for creation
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',//Chatroom ID
 * 'name'=> 'RongCloud',//Chatroom name
 * ];
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
 * Chatroom Creation
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',//  Chatroom ID
 * 'destroyType' => 0,//  Specifies the destruction type of the chatroom 0: Default value, indicates destruction when inactive, 1: Fixed time destruction
 * 'destroyTime' => 60,//  Sets the destruction time of the chatroom
 * 'isBan' => false,//  Whether to ban all members of the chatroom, default false
 * 'whiteUserIds' => ['user1','user2'],//  Whitelist user list for banning, supports batch setting, maximum not exceeding 20
 * 'entryOwnerId' => '',//  The owner user ID of the chatroom's custom properties.
 * 'entryInfo' => '',//  Custom properties KV pair of the chatroom, JSON structure.
 * ];
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
 * Set chatroom destruction type
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',  //Chatroom id
 * 'destroyType'=> 0,      //Specifies the destruction method of the chatroom.
 * 'destroyTime'=> 60      //Set the destruction time of the chatroom.
 * ];
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
 * Destroy chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',//chatroom id
 * ];
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
 * Query chatroom basic information
 *
 * @DateTime 2023-06-14
 * @deprecated Deprecated, please use the queryV2 method for creation
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
 * Query chatroom basic information V2
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
 * Get chatroom members
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',// Chatroom ID
 * 'count'=>10,// Number of chatroom members, maximum return 500 members
 * 'order'=>2// Query order of chatroom members, 1: Join time ascending 2: Join time descending
 * ];
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
 * Check if the user is in the chatroom
 *
 * @param array $Chatroom
 * $Chatroom = [
 * 'id'=> 'chatroom9992',//  Chatroom ID
 * 'members'=>[
 * ['id'=>"sea9902"]//  Member ID
 * ]
 * ];
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
 * Create a global mute object for the chat room
 *
 * @return MuteWhiteList
 */
    public function Ban(){
        return new Ban();
    }

    /**
 * Create a chat room block object
 *
 * @return Block
 */
    public function Block(){
        return new Block();
    }

    /**
 * Create a chat room message demotion object
 *
 * @return Demotion
 */
    public function Demotion(){
        return new Demotion();
    }

    /**
 * Create a chat room message distribution object
 *
 * @return Distribute
 */
    public function Distribute(){
        return new Distribute();
    }

    /**
 * Create a chat room member gag object
 *
 * @return Gag
 */
    public function Gag(){
        return new Gag();
    }

    /**
 * Create a chat room keepalive object
 *
 * @return Keepalive
 */
    public function Keepalive(){
        return new Keepalive();
    }

    /**
 * Create a chat room user whitelist object
 *
 * @return Whitelist
 */
    public function Whitelist(){
        return new Whitelist();
    }

    /**
 * Create a chat room whitelist message object
 *
 * @return Message
 */
    public function Message(){
        return new Message();
    }

    /**
 * Create a whitelist message object for the chat room
 *
 * @return Entry
 */
    public function Entry(){
        return new Entry();
    }

    /**
 * Mute all members in the chat room
 *
 * @return MuteAllMembers
 */
    public function MuteAllMembers(){
        return new MuteAllMembers();
    }

    /**
 * Chat room global mute whitelist
 *
 * @return MuteWhiteList
 */
    public function MuteWhiteList(){
        return new MuteWhiteList();
    }
}