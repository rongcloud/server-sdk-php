<?php
/**
 * 历史消息
 */
namespace RongCloud\Lib\Message\History;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class History {
    private $jsonPath = 'Lib/Message/History/';

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
     * History constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');;
    }

    /**
     * @param $Message array 历史消息获取
     * @param
     * $Message = [
            'date'=> '2018030613',//日期
        ];
     * @return array
     */
    public function get(array $Message=[]){
        $conf = $this->conf['get'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $Message,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$Message);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * @param $Message array 历史消息文件删除
     * @param
     * $Message = [
        'date'=> '2018030613',//日期
    ];
     * @return array
     */
    public function remove(array $User=[]){
        $conf = $this->conf['remove'];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'message',
            'data'=> $User,
            'verify'=> $this->verify['message']
        ]);
        if($error) return $error;
        $result = (new Request())->Request($conf['url'],$User);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
         * @param $Message array 消息清除
         * @param
         * $Message = [
            'conversationType'=> '1',//会话类型，支持单聊、群聊、系统会话。单聊会话是 1、群组会话是 3、系统通知是 6
            'fromUserId'=>"fromUserId",//用户 ID，删除该用户指定会话 msgTimestamp 前的历史消息
            'targetId'=>"userId",//需要清除的目标会话 ID
            'msgTimestamp'=>"16888383883222",//清除该时间戳之前的所有历史消息，精确到毫秒，为空时清除该会话的所有历史消息。

        ];
         * @return array
         */
        public function clean(array $User=[]){
            $conf = $this->conf['clean'];
            $error = (new Utils())->check([
                'api'=> $conf,
                'model'=> 'message',
                'data'=> $User,
                'verify'=> $this->verify['clean']
            ]);
            if($error) return $error;
            $result = (new Request())->Request($conf['url'],$User);
            $result = (new Utils())->responseError($result, $conf['response']['fail']);
            return $result;
        }
}