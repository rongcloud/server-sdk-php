<?php

/**
 * Message Extension
 */

namespace RongCloud\Lib\Message\Expansion;

use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Expansion
{

    /**
 * @var string Message Extension
 */
    private $jsonPath = 'Lib/Message/Expansion/';

    /**
 * Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * Validate configuration file
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
 * 'userId'            => 'WNYZbMqpH',             //The ID of the user who needs to set the extension for the message.
 * 'targetId'          => 'tjw3zbMrU',             //Target ID, which could be a user ID or a group ID depending on the conversationType.
 * 'conversationType'  => '1',                     //Conversation type, 1 for one-on-one chat and 3 for group chat, only supports single chat and group chat types.
 * 'extraKeyVal'       => ['type'=>'3'],           //Custom message extension content, JSON structure, set in Key-Value pairs, e.g., {"type":"3"}, a single message can set up to 300 extension information, with a maximum of 100 settings at a time.
 * 'isSyncSender'      => 0                        //In the online state of the terminal user, whether the sender receives this setting status, 0 means not receiving, 1 means receiving, default is 0 not receiving
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
 * Delete Message Extension
 *
 * @param array $param Parameters for deleting message extension
 * @param
 * $param = [
 * 'msgUID'            => 'BRGM-DEN2-01E4-BN66',   //Message unique identifier ID, which can be obtained by the server through the full message routing function.
 * 'userId'            => 'WNYZbMqpH',             //User ID of the message sender who needs to set the extension.
 * 'targetId'          => 'tjw3zbMrU',             //Target ID, which could be a user ID or group ID depending on the conversationType.
 * 'conversationType'  => '1',                     //Conversation type, where 1 represents a one-on-one chat and 3 represents a group chat. Only single chat and group chat types are supported.
 * 'extraKey'          => ['type'],                 //Key values of the extension information to be deleted. A maximum of 100 extension information items can be deleted at once.
 * 'isSyncSender'      => 0                        //Indicates whether the sender receives this setting status when the terminal user is online. 0 means not receiving, 1 means receiving, and the default is 0 (not receiving).
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
 * 'pageNo' => 1          // Page number, defaults to returning 300 pieces of extension information.
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
