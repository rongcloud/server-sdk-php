<?php
/**
 * 会话模块
 * conversation=> hejinyu
 * Date=> 2018/7/23
 * Time=> 11=>41
 */
namespace RongCloud\Lib\Conversation;

use MongoDB\BSON\ObjectId;
use RongCloud\Lib\ConversationType;
use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;
class Conversation
{
    /**
     * 会话模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Conversation/';

    /**
     * 请求配置文件
     *
     * @var string
     */
    private $conf = "";

    /**
     * 校验配置文件
     *
     * @var string
     */
    private $verify = "";

    /**
     * Conversation constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * 屏蔽会话 Push
     *
     * @param $Conversation array 屏蔽会话 Push 参数
     * @param
     * $Conversation = [
            'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
            'userId'=>'mka091amn',//会话所有者
            'targetId'=>'adm1klnm'//会话 id
        ];
     * @return array
     */
    public function mute(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
                    'api'=> $conf,
                    'model'=> 'conversation',
                    'data'=> $Conversation,
                    'verify'=> $this->verify['conversation']
                ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 1;
        $Conversation = (new Utils())->rename($Conversation, [
                'type'=> 'conversationType',
                'userId'=> 'requestId'
            ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 接收会话 Push
     *
     * @param $Conversation array 接收会话 Push 参数
     * @param
     * $Conversation = [
            'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
            'userId'=>'mka091amn',//会话所有者
            'targetId'=>'adm1klnm'//会话 id
        ];
     * @return array
     */
    public function unmute(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'conversation',
            'data'=> $Conversation,
            'verify'=> $this->verify['conversation']
        ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 0;
        $Conversation = (new Utils())->rename($Conversation, [
            'type'=> 'conversationType',
            'userId'=> 'requestId'
        ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 免打扰会话状态获取
     *
     * @param $Conversation array 接收会话 Push 参数
     * @param
     * $Conversation = [
    'type'=> 'PRIVATE',//会话类型 PRIVATE、GROUP、DISCUSSION、SYSTEM
    'userId'=>'mka091amn',//会话所有者
    'targetId'=>'adm1klnm'//会话 id
    ];
     * @return array
     */
    public function get(array $Conversation=[]){
        $conf = $this->conf['mute'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'conversation',
            'data'=> $Conversation,
            'verify'=> $this->verify['conversation']
        ]);
        if($error) return $error;
        $Conversation['type'] = ConversationType::t()[$Conversation['type']];
        $Conversation['isMuted'] = 0;
        $Conversation = (new Utils())->rename($Conversation, [
            'type'=> 'conversationType',
            'userId'=> 'requestId'
        ]);
        $result = (new Request())->Request($conf['url'],$Conversation);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }


}