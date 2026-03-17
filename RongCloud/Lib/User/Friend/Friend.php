<?php

/**
 * Friend profile (info hosting) - Get user friend list
 */

namespace RongCloud\Lib\User\Friend;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Friend
{

    /**
     * User module path to friend
     *
     * @var string
     */
    private $jsonPath = 'Lib/User/Friend/';

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
     * Friend constructor.
     */
    function __construct()
    {
        $this->conf   = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');
    }

    /**
     * Get user friend list
     *
     * @param array $params Parameters
     * @param
     * $params = [
     *   'userId'    => 'id1',      // Operator user id, required
     *   'pageToken' => 'XM2AKD1B2AH', // Page token for pagination, omit on first call, use returned pageToken on next call
     *   'size'      => 50,         // Page size, default 50, max 100
     *   'order'     => 0           // Sort: 0 by add time ascending (default); 1 by add time descending
     * ];
     * Or use 'id' as userId: $params = [ 'id' => 'id1', 'size' => 60, 'order' => 1 ];
     * @return array
     */
    public function get(array $params = [])
    {
        $conf = $this->conf['get'];
        $data = $params;
        if (isset($data['id'])) {
            $data['userId'] = $data['id'];
            unset($data['id']);
        }
        $error = (new Utils())->check([
            'api'    => $conf,
            'model'  => 'friendGet',
            'data'   => $data,
            'verify' => $this->verify['friendGet']
        ]);
        if ($error) {
            return $error;
        }
        $result = (new Request())->Request($conf['url'], $data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * Check friend relationship between operator and target users
     *
     * @param array $params Parameters
     * @param
     * $params = [
     *   'userId'    => 'id1',           // Operator user id, required
     *   'targetIds' => ['id2', 'id3'],  // Target user ids to check, required, max 100
     * ];
     * Or use 'id' as userId: $params = [ 'id' => 'id1', 'targetIds' => ['id2', 'id3'] ];
     * @return array results[i].result: 1 = not friends; 4 = mutual friends; 2,3 = reserved
     */
    public function check(array $params = [])
    {
        $conf = $this->conf['check'];
        $data = $params;
        if (isset($data['id'])) {
            $data['userId'] = $data['id'];
            unset($data['id']);
        }
        $error = (new Utils())->check([
            'api'    => $conf,
            'model'  => 'friendCheck',
            'data'   => $data,
            'verify' => $this->verify['friendCheck']
        ]);
        if ($error) {
            return $error;
        }
        if (is_array($data['targetIds'])) {
            $data['targetIds'] = implode(',', $data['targetIds']);
        }
        $result = (new Request())->Request($conf['url'], $data);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
