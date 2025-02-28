<?php
/**
 * // Super cluster module
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup;

use RongCloud\Lib\Ultragroup\Gag\Gag;
use RongCloud\Lib\Ultragroup\MuteAllMembers\MuteAllMembers;
use RongCloud\Lib\Ultragroup\MuteWhiteList\MuteWhiteList;
use RongCloud\Lib\Ultragroup\Expansion\Expansion;
use RongCloud\Lib\Ultragroup\BusChannel\BusChannel;
use RongCloud\Lib\Ultragroup\Notdisturb\Notdisturb;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Ultragroup
{
    /**
 * Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Verify configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Create a super group
 *
 * @param array $Group Parameters for creating a super group
 * @param
 * $Group = [
 * 'id'=> 'watergroup1', // Super group ID
 * 'name'=> 'watergroup', // Super group name
 * ];
 * @return array
 */
    public function create(array $Group=[]){
        $conf = $this->conf['create'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $this->verify['group']
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 *  Join a super group
 *
 * @param array $Group Parameters for joining a super group
 * @param
 * $Group = [
 * 'id'=> 'watergroup', // Super group ID
 * 'name'=>"watergroup", // Super group name
 * 'member'=>['id'=> 'group999'], // Group member information
 * ];
 * @return array
 */
    public function joins(array $Group=[]){
        $conf = $this->conf['join'];
        $verify = $this->verify['group'];
        $verify = array_merge($verify,$this->verify['member']);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Exit super group
 *
 * @param array $Group Exit super group parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup', // Super group id
 * 'member'=>['id'=> 'group999'], // Group member information
 * ];
 * @return array
 */
    public function quit(array $Group=[]){
        $conf = $this->conf['quit'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $verify = array_merge($verify,$this->verify['member']);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Disband supergroup
 *
 * @param array $Group Disband supergroup parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//supergroup id
 * 'member'=>['id'=> 'group999'],//admin information
 * ];
 * @return array
 */
    public function dismiss(array $Group=[]){
        $conf = $this->conf['dis'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group['member'] = isset($Group['member']['id'])?$Group['member']['id']:"";
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Modify group information
 *
 * @param array $Group Modify group information parameters
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//Super group id
 * 'name'=>"watergroup"//group name
 * ];
 * @return array
 */
    public function update(array $Group=[]){
        $conf = $this->conf['refresh'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'],'name'=>$verify['name']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Does the super member exist
 *
 * @param array $Group Modify group information parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//Super group id
 * 'member'=>"userId" //Member id
 * ];
 * @return array
 */
    public function isExist(array $Group=[]){
        $conf = $this->conf['isExist'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'],'member'=>$verify['member']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }


    /**
 * // Create a super group gag object
 *
 * @return Gag
 */
    public function Gag(){
        return new Gag();
    }

    /**
 * Create a specified supergroup member mute command
 *
 * @return MuteAllMembers
 */
    public function MuteAllMembers(){
        return new MuteAllMembers();
    }
    /**
 * // Create a mute for all members of the specified supergroup
 *
 * @return MuteWhiteList
 */
    public function MuteWhiteList(){
        return new MuteWhiteList();
    }

    /**
 * // Super Group Expansion
 *
 * @return Expansion
 */
    public function Expansion(){
        return new Expansion();
    }

    /**
 * // Super Cluster Expansion
 *
 * @return BusChannel
 */
    public function BusChannel(){
        return new BusChannel();
    }

    /**
 * // Super group expansion does not disturb
 *
 * @return Notdisturb
 */
    public function Notdisturb(){
        return new Notdisturb();
    }


}