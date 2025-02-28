<?php

/**
 * // Super group message extension
 */

namespace RongCloud\Lib\Ultragroup\Expansion;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Expansion
{

    /**
 * @var string Message Extension
 */
    private $jsonPath = 'Lib/Ultragroup/Expansion/';

    /**
 * // Request configuration file
 *
 * @var string
 */
    private $conf = '';

    /**
 * Verification configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Person constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
 * Set message extension
 *
 * @param array $param Set message extension parameters
 * @param
 * $param = [
 * 'msgUID'            => 'BRGM-DEN2-01E4-BN66',   //Message unique identifier ID, which can be obtained by the server through the full message routing function.
 * 'userId'            => 'WNYZbMqpH',             //The ID of the user who needs to set the extension for message sending.
 * 'groupId'          => 'tjw3zbMrU',             //Group ID
 * 'busChannel'  => '',                     //Bus channel
 * 'extraKeyVal'       => ['type'=>'3']            //Custom message extension content in JSON structure, set in Key-Value pairs, e.g., {"type":"3"}. A single message can set up to 300 extension items, with a maximum of 100 items per setting.
 * ];
 * @return array
 */
    public function set(array $param = [])
    {
        $conf = $this->conf['set'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'expansion',
            'data' => $param,
            'verify' => $this->verify['expansion']
        ]);
        if ($error) return $error;
        if (is_array($param['extraKeyVal'])) {
            $param['extraKeyVal'] = json_encode($param['extraKeyVal'], JSON_UNESCAPED_UNICODE);
        }
        $result = (new Request())->Request($conf['url'], $param);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Delete message extension
 *
 * @param array $param Parameters for deleting message extension
 * @param
 * $param = [
 * 'msgUID'            => 'BRGM-DEN2-01E4-BN66',   //Message unique identifier ID, which can be obtained by the server through the full message routing function.
 * 'userId'            => 'WNYZbMqpH',             //The user ID of the message sender that needs to set the extension.
 * 'groupId'          => 'tjw3zbMrU',             //Super group ID
 * 'conversationType'  => '1',                     //Conversation type, 1 for one-on-one chat, 3 for group chat. Only single chat and group chat types are supported.
 * 'extraKey'          => ['type']                 //The Key value of the extension information to be deleted, with a maximum of 100 extension information items that can be deleted at once.
 * 'busChannel         => ""                       //buschannel can be empty
 * ];
 * @return array
 */
    public function delete(array $param = [])
    {
        $conf = $this->conf['remove'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'expansion',
            'data' => $param,
            'verify' => $this->verify['expansion']
        ]);
        if ($error) return $error;
        if (is_array($param['extraKey'])) {
            $param['extraKey'] = json_encode($param['extraKey'], JSON_UNESCAPED_UNICODE);
        }
        $result = (new Request())->Request($conf['url'], $param);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * Get extension information
 *
 * @param array $param Parameters for obtaining extension information
 * @param
 * $param = [
 * 'msgUID' => 'ujadk90ha', // Message unique identifier ID, which can be obtained by the server through the full message routing function.
 * 'pageNo' => 1          // Page number, defaults to returning 300 extension information.
 * ];
 * @return array
 */
    public function getList(array $param = [])
    {
        $conf = $this->conf['getList'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'expansion',
            'data' => $param,
            'verify' => $this->verify['expansion']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $param);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
