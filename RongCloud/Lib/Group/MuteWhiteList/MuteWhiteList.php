<?php
/**
 * Group blacklist
 * @author hejinyu
 */
namespace RongCloud\Lib\Group\MuteWhiteList;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class MuteWhiteList
{
    /**
 * Group module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Group/MuteWhiteList/';

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
 * Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Add group ban whitelist
 *
 * @param array $Group Add group ban whitelist parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',// Group ID
 * 'members'=>[ // Ban list
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $verify = array_merge($verify , ['minute'=>$verify['minute']]);
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
            'id'=> 'groupId',
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unblock users from the mute list
 *
 * @param array $Group Parameters for unblocking users from the mute list
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',// Group ID
 * 'members'=>[ // List of users to unblock
 * ['id'=> 'ujadk90ha']
 * ]
 * ];
 * @return array
 */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
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
            'id'=> 'groupId',
            'members'=> 'userId'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Query the list of members in the banned words whitelist
 *
 * @param array $Group  Parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//group id
 * ];
 * @return array
 */
    public function getList(array $Group=[]){
        $conf = $this->conf['getList'];
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
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
        }
        return $result;
    }

}
