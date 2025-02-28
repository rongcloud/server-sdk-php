<?php
/**
 * // Push module
 * conversation=> hejinyu
 */
namespace RongCloud\Lib\Push;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Push
{
    /**
 * // Push module path
 *
 * @var string
 */
    private $jsonPath = 'Lib/Push/';

    /**
 * // Request configuration file
 *
 * @var string
 *
 */
    private $conf = '';

    /**
 * // Verify configuration file
 *
 * @var string
 */
    private $verify = '';

    /**
 * Push constructor.
 */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
 * Broadcast Message
 *
 * @param array $Push Push parameters
 * @param
 * $Push = [
 * 'platform'=> ['ios','android'],//Target operating systems
 * 'fromuserid'=>'mka091amn',//Sender user ID
 * 'audience'=>['is_to_all'=>true],//Push conditions, including: tag, userid, is_to_all.
 * 'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],//Message content to be sent
 * 'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]//Push display
 * ];
 * @return array
 */
    public function broadcast(array $Push=[]){
        $conf = $this->conf['broadcast'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'broadcast',
                    'data'=> $Push,
                    'verify'=> $this->verify['broadcast']
                ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Push,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
 * push
 *
 * @param Push $Push parameter
 * @param
 * $Push = [
 * 'platform'=> ['ios','android'],//Target operating systems
 * 'audience'=>['is_to_all'=>true],//Push conditions, including: tag, userid, is_to_all.
 * 'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]//Push display
 * ];
 * @return array
 */
    public function push(array $Push=[]){
        $conf = $this->conf['push'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'broadcast',
            'data'=> $Push,
            'verify'=> $this->verify['push']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Push,'json');
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }


}