<?php
namespace RongCloud\Lib\Ultragroup\Notdisturb;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

/**
 * Super anti-interference
 */
class Notdisturb {
    /**
 * Super cluster module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Ultragroup/Notdisturb/';

    /**
 * Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * // Verify configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * // Conversation constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Set Super Group Do Not Disturb
 *
 * @param array $Group Add super group mute parameters
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha', // Super group id
 * 'busChannel'=> 'busid', // Channel id (can be empty)
 * 'unpushLevel'=> -1, // Ultra group Do Not Disturb Level
 * -1: Notify all messages
 * 0: Not set (default state for users, notify all messages; if super group default state is set, follow super group default settings)
 * 1: Notify only @ messages, including @ specific user and @ everyone
 * 2: Notify only @ specific user messages, and only notify the user who is @ mentioned.
 * Example: @Zhang San will receive the notification, @ everyone will not receive the notification.
 *
 * 4: Notify only @ group members, only receive @ everyone notifications
 * 5: Do not receive notifications, even for @ messages.
 * ];
 * @return array
 */
    public function set(array $Group=[]){
        $conf = $this->conf['add'];
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
        return $result;
    }

    /**
 * Query the super group/channel do-not-disturb status
 *
 * @param array $Group ultra group parameter
 * @param
 * $Group = [
 * 'id'=> 'ujadk90ha',//super group id
 * 'busChannel'=> 'busid',//channel id, can be empty
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
        return $result;
    }

}