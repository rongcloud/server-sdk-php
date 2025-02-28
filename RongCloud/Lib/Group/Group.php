<?php
/**
 * // Group module
 * @author hejinyu
 */
namespace RongCloud\Lib\Group;

use RongCloud\Lib\Group\Gag\Gag;
use RongCloud\Lib\Group\MuteAllMembers\MuteAllMembers;
use RongCloud\Lib\Group\MuteWhiteList\MuteWhiteList;
use RongCloud\Lib\Group\Remark\Remark;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Group
{
    /**
 * Group module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Group/';

    /**
 * // Request configuration file
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
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Synchronize group information
 *
 * @param array $Group Synchronized group information parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//User ID
 * 'groups'=>[['id'=> 'group9998', 'name'=> 'RongCloud']]//User group information
 * ];
 * @return array
 */
    public function sync(array $Group=[]){
        $conf = $this->conf['sync'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'user',
                    'data'=> $Group,
                    'verify'=> $this->verify['user']
                ]);
        if($error) return $error;
        $data = [];
// $data['group'] = array_column($Group['groups'], 'name', 'id');
        foreach ($Group['groups'] as $v){
            $data["group[{$v['id']}]"] = $v['name'];
        }
        $data['userId'] = $Group['id'];
        $result = (new Request())->Request($conf['url'],$data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Create Group
 *
 * @param array $Group Parameters for creating a group
 * @param
 * $Group = [
 * 'id'=> 'watergroup1', // Group ID
 * 'name'=> 'watergroup', // Group name
 * 'members'=>[          // List of group members
 * ['id'=> 'group9991111113']
 * ]
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
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'name'=> 'groupName',
            'members'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Join a group
 *
 * @param array $Group Parameters for joining a group
 * @param
 * $Group = [
 * 'id'=> 'watergroup', // Group ID
 * 'name'=>"watergroup", // Group name
 * 'member'=>['id'=> 'group999'], // Group member information
 * ];
 * @return array
 */
    public function joins(array $Group=[]){
        $conf = $this->conf['join'];
        $verify = $this->verify['group'];
        unset($verify['memberIds'],$verify['name']);
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
            'name'=> 'groupName',
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Exit group
 *
 * @param array $Group Exit group parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup', // Group id
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
 * Disband group
 *
 * @param array $Group Disband group parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//Group ID
 * 'member'=>['id'=> 'group999'],//Administrator information
 * ];
 * @return array
 */
    public function dismiss(array $Group=[]){
        $conf = $this->conf['dismiss'];
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
            'member'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Modify group information
 *
 * @param array $Group Modify group information parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//group id
 * 'name'=>"watergroup"//group name
 * ];
 * @return array
 */
    public function update(array $Group=[]){
        $conf = $this->conf['update'];
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
 * Get group information
 *
 * @param array $Group Get group information parameter
 * @param
 * $Group = [
 * 'id'=> 'watergroup',//group id
 * ];
 * @return array
 */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200) {
            $result = (new Utils())->rename($result, [
                'users'=> 'members',
            ]);
        }
        return $result;
    }

    /**
 * Create a group gag object
 *
 * @return Gag
 */
    public function Gag(){
        return new Gag();
    }

    /**
 * Create a full member mute for the specified group
 *
 * @return MuteAllMembers
 */
    public function MuteAllMembers(){
        return new MuteAllMembers();
    }
    /**
 * Create a mute whitelist for all members of the specified group
 *
 * @return MuteWhiteList
 */
    public function MuteWhiteList(){
        return new MuteWhiteList();
    }

    /**
 * // Group member remark
 *
 * @return Remark
 */
    public function Remark(){
        return new Remark();
    }

}