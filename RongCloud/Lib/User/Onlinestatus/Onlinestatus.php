<?php
/**
 * User module User Online Status
 */
namespace RongCloud\Lib\User\Onlinestatus;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Utils;

class Onlinestatus {

    /**
 * User module user status
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Onlinestatus/';

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
 * User constructor.
 */
    function __construct()
    {
        // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
 * Check user online status
 *
 * @param array $User Parameters for checking user online status
 * @param
 * $User = [
 * 'id'=> 'ujadk90ha1',//User ID, unique identifier, maximum length 30 characters
 * ];
 * @return array
 */
    public function check(array $User=[]){
        $conf = $this->conf['get'];
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
}