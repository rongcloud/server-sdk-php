<?php
/**
 * // Banned user relationship
 */
namespace RongCloud\Lib\User\Block;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Utils;

class Block {

    /**
 * // User module path to block user
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Block/';

    /**
 * // Request configuration file
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
 * // User constructor.
 */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * // Add banned user
 *
 * @param array $User Banned user parameters
 * @param
 * $User = [
 * 'id'=> 'ujadk90ha1',// Banned user ID, unique identifier, maximum length 30 characters
 * 'minute'=> 20 // Ban duration 1 - 1 * 30 * 24 * 60 minutes
 * ];
 * @return array
 */
    public function add(array $User=[]){
        $conf = $this->conf['add'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['user']
        ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Unblock user
 *
 * @param array $User Unblock parameters
 * @param
 * $user = [
 * 'id'=> 'ujadk90ha',//Unblock user ID, unique identifier, maximum length 30 characters
 * ];
 * @return array
 */
    public function remove(array $User=[]){
        $conf = $this->conf['remove'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'user',
            'data'=> $User,
            'verify'=> $this->verify['user']
        ]);
        if($error) return $error;
        $User = (new Utils())->rename($User, [
            'id'=> 'userId',
        ]);
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get the list of banned users
 *
 * @param array $User Banned user list parameter
 * @param
 * $user = [
 * ];
 * @return  array
 */
    public function getList(array $User=[]){
        $conf = $this->conf['getList'];
        $result = (new Request())->Request($conf['url'],$User);
// foreach ($result[''])
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}