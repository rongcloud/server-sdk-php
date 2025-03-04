<?php
/**
 * User module global group member ban service
 */
namespace RongCloud\Lib\User\MuteGroups;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Utils;

class MuteGroups {

    /**
 * User module global group member mute service
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/MuteGroups/';

    /**
 * Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * Configuration file for verification
 *
 * @var string
 */
    private $verify = '';

    /**
 * User constructor.
 */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Add group ban
 *
 * @param array $Group Parameters for adding group ban
 * @param
 * $Group = [
 * 'members'=>[ // List of banned members
 * ['id'=> 'ujadk90ha']
 * ],
 * 'minute'=>50  // Duration of ban in minutes
 * ];
 * @return array
 */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['members'=>$verify['members']];
        $verify = array_merge($verify , ['minute'=>$this->verify['minute']]);
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unban
 *
 * @param array $Group Unban parameter
 * @param
 * $Group = [
 * 'members'=>[ //Unban member list
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of banned members
 *
 * @param array $Group Query the list of banned members
 * @param
 * $Group = [
 * ];
 * @return array
 */
    public function getList(array $Group=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members']?:[] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

}