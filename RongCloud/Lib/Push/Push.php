<?php
/**
 * 推送模块
 * conversation=> hejinyu
 */
namespace RongCloud\Lib\Push;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Push
{
    /**
     * 推送模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Push/';

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
     * Push constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'verify.json');
    }

    /**
     * 广播消息
     *
     * @param $Push array Push 参数
     * @param
     * $Push = [
             'platform'=> ['ios','android'],//目标操作系统
            'fromuserid'=>'mka091amn',//送人用户 Id
            'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
            'message'=>['content'=>json_encode(['content'=>'1111','extra'=>'aaa']),'objectName'=>'RC:TxtMsg'],//发送消息内容
            'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]//推送显示
        ];
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
     * @param $Push  Push 参数
     * @param
     * $Push = [
             'platform'=> ['ios','android'],//目标操作系统
            'audience'=>['is_to_all'=>true],//推送条件，包括： tag、userid、is_to_all。
            'notification'=>['alert'=>"this is a push",'ios'=>['alert'=>'abc'],'android'=>['alert'=>'abcd']]//推送显示
        ];
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