<?php

/**
 * User mute list
 */

namespace RongCloud\Lib\User\Chat;

use RongCloud\Lib\Request;
use RongCloud\Lib\User\User;
use RongCloud\Lib\Utils;

class Ban
{

    /**
 * // User module user single chat forbidden path
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Chat/';

    /**
 * // Request configuration file
 *
 * @var string
 * // Configuration file path
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
        // // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
 * Set user single chat ban
 *
 * @param array $User Set user single chat ban parameters
 * @param
 * $User = [
 * 'id'    => ['ujadk90ha1'],  //Banned user Id, supports batch setting, maximum not exceeding 1000.
 * 'state' => 1,               //Ban status, 0 unban, 1 add ban
 * 'type'  => 'PERSON'         //Conversation type, currently supports single chat PERSON
 * ];
 * @return array
 */
    public function set(array $User = [])
    {
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'user',
            'data' => $User,
            'verify' => $this->verify['set']
        ]);
        if ($error) return $error;
        $User = (new Utils())->rename($User, [
            'id' => 'userId',
        ]);
        $result = (new Request())->Request($conf['url'], $User);
        $bodyParameter = (new Request())->getQueryFields($User);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }

    /**
 * // Query the list of banned users
 *
 * @param array $param Parameters for querying the list of banned users
 * @param
 * $param = [
 * 'num'    => 100,        // Number of rows to fetch, default is 100, maximum supported is 200.
 * 'offset' => 0,          // Starting position for the query, default is 0.
 * 'type'   => 'PERSON'    // Conversation type, currently supports single chat PERSON
 * ];
 * @return  array
 */
    public function getList(array $param = [])
    {
        $conf = $this->conf['getList'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'param',
            'data' => $param,
            'verify' => $this->verify['getList']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $param);
        $bodyParameter = (new Request())->getQueryFields($param);
        $result = (new Utils())->responseError($result, $conf['response']['fail'], $bodyParameter);
        return $result;
    }
}
