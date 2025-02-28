<?php

/**
 * User hosting
 */

namespace RongCloud\Lib\User\Profile;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Profile
{

    /**
 * User Entrustment
 *
 * @var string
 */
    private $jsonPath = 'Lib/User/Profile/';

    /**
 * // Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * // Configuration file for validation
 *
 * @var string
 * //
 */
    private $verify = '';

    /**
 * Profile constructor.
 */
    function __construct()
    {
        // // Initialize request configuration and validate file path
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');
    }

    /**
 * User profile settings
 *
 * @param array
 * $params = [
 * 'userId' => 'ujadk90ha1', // User ID
 * 'userProfile' => [],      // Basic user information (default maximum of 20 items)
 * 'userExtProfile' => []    // Extended user information (key length does not exceed 32 characters, key must be prefixed with ext_, value length does not exceed 256 characters, default maximum of 20 items)
 * ];
 * @return array
 */
    public function set(array $params = [])
    {
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['set']
        ]);
        if ($error) return $error;
        if (isset($params['userProfile'])) {
            if (is_array($params['userProfile'])) {
                $params['userProfile'] = json_encode($params['userProfile'], JSON_UNESCAPED_UNICODE);
            }
        }
        if (isset($params['userExtProfile'])) {
            if (is_array($params['userExtProfile'])) {
                $params['userExtProfile'] = json_encode($params['userExtProfile'], JSON_UNESCAPED_UNICODE);
            }
        }
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * User custody information clearance
 *
 * @param array
 * $params = [
 * 'userId'=> ['ujadk90ha1','ujadk90ha1'], // User ID list, up to 20 users at a time
 * ];
 * @return array
 */
    public function clean(array $params = [])
    {
        $conf = $this->conf['clean'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['clean']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Batch query user data
 *
 * @param array
 * $params = [
 * 'userId'=> ['ujadk90ha1','ujadk90ha1'],//User ID list, maximum 100 per batch
 * ];
 * @return array
 */
    public function batchQuery(array $params = [])
    {
        $conf = $this->conf['batchQuery'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['batchQuery']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * // Get paginated list of all application users
 *
 * @param array
 * $params = [
 * 'page'  => 1,   // Default is 1
 * 'size'  => 20,  // Default is 20, maximum is 100
 * 'order' => 0,   // Sorting mechanism based on registration time, default is ascending, 0 for ascending, 1 for descending
 * ];
 * @return array
 */
    public function query(array $params = [])
    {
        $conf = $this->conf['query'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'profile',
            'data' => $params,
            'verify' => $this->verify['query']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $params);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
