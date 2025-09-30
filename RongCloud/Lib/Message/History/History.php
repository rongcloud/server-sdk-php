<?php

/**
 * Historical message
 */

namespace RongCloud\Lib\Message\History;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class History
{
    private $jsonPath = 'Lib/Message/History/';

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
     * History constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . 'verify.json');;
    }

    /**
     * @param array $Message History message retrieval
     * @param
     * $Message = [
     * 'date'=> '2018030613',//Date
     * ];
     * @return array
     */
    public function get(array $Message = [])
    {
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $Message,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message History message file deletion
     * @param
     * $Message = [
     * 'date'=> '2018030613',//Date
     * ];
     * @return array
     */
    public function remove(array $User = [])
    {
        $conf = $this->conf['remove'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $User,
            'verify' => $this->verify['message']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param array $Message Message clearance
     * @param
     * $Message = [
     * 'conversationType'=> '1',//Conversation type, supports single chat, group chat, system message. Single chat is 1, group chat is 3, system notification is 6
     * 'fromUserId'=>"fromUserId",//User ID, delete the specified user's historical messages before the msgTimestamp
     * 'targetId'=>"userId",//Target conversation ID that needs to be cleared
     * 'msgTimestamp'=>"16888383883222",//Clear all historical messages before this timestamp, accurate to milliseconds, leave empty to clear all historical messages of the conversation.
     *
     * ];
     * @return array
     */
    public function clean(array $User = [])
    {
        $conf = $this->conf['clean'];
        $error = (new Utils())->check([
            'api' => $conf,
            'model' => 'message',
            'data' => $User,
            'verify' => $this->verify['clean']
        ]);
        if ($error) return $error;
        $result = (new Request())->Request($conf['url'], $User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }
}
