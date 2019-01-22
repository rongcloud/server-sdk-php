<?php
/**
 * 历史消息
 */
namespace RongCloud\Lib\Message\History;

use RongCloud\Lib\Request;
use Rongcloud\Lib\Utils;

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
}