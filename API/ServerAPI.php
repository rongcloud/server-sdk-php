<?php

/**
 * 融云server API 接口
 * Class ServerAPI
 * @author  caolong
 * @date    2014-11-14
 */

/**
include('ServerAPI.php');
$p = new ServerAPI( 'appKey','appSecret','/group/sync',
array('userId'=>11,'group'=>array('name'=>'xxxx'))
);
$r = $p->request();
print_r($r);
 */

class ServerAPI{
    private $httpHeaderData = '';   //http header
    private $params = [];           //参数数组
    private $action;                //请求放放
    private $appKey;                //appKey
    private $appSecret;             //secret
    const   SERVERAPIURL = 'https://api.cn.rong.io';    //请求服务地址
    private $format;                //数据格式 json/xml


    /**
     * 参数初始化
     * @param $appKey
     * @param $appSecret
     * @param string $action
     * @param array $params
     */
    public function __construct($appKey,$appSecret,$action,$params=[],$format = 'json'){
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->params = $params;
        $this->action = $action;
        $this->format = $format;
        $this->createHttpHeader();
    }


    /**
     * 数据处理
     * @return array
     */
    public  function request() {
        $methods = $this->getAllowMethods();
        try{
            if(empty($methods[$this->action]))
                throw new Exception('请求方法错误','3001');
            $data = [];
            foreach($methods[$this->action] as $key => $val) {
                if(is_array($val)) {
                    foreach($val as $k=>$v) {
                        if(!empty($this->params[$v])) {
                            $arrKeys = array_keys($this->params[$v]);
                            $arrValues = array_values($this->params[$v]);
                            $string = $v."[".$arrKeys[0]."]";
                            $data[$string] = $arrValues[0];
                        }
                    }
                }else{
                    if(!empty($this->params[$val])) {
                        $data[$val] = $this->params[$val];
                    }
                }
            }
            return $this->curl($this->action,$data,$this->httpHeaderData);
        }catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * 创建http header参数
     * @param array $data
     * @return bool
     */
    private function createHttpHeader() {
        $nonce = mt_rand();
        $timeStamp = time();
        $sign = sha1($this->appSecret.$nonce.$timeStamp);
        $this->httpHeaderData = array(
            'App-Key:'.$this->appKey,
            'Nonce:'.$nonce,
            'Timestamp:'.$timeStamp,
            'Signature:'.$sign,
        );
    }


    /**
     * @param $action
     * @param $params
     * @param $httpHeader
     * @return mixed
     */
    public  function curl($action,$params,$httpHeader) {
        $action = self::SERVERAPIURL.$action.'.'.$this->format;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false); //处理http证书问题
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $ret = curl_exec($ch);
        if (false === $ret) {
            $ret =  curl_errno($ch);
        }
        curl_close($ch);
        return $ret;
    }


    /**
     * 获取允许请求的方法
     * @return array
     */
    private function getAllowMethods() {
        return array(
            '/user/getToken'=>array('userId','name','portraitUri'),
            '/message/publish'=>array('fromUserId','toUserId','objectName','content'),
            '/message/system/publish'=>array('fromUserId','toUserId','objectName','content','pushContent','pushData'),
            '/message/group/publish'=>array('fromUserId','toGroupId','objectName','content','pushContent','pushData'),
            '/message/chatroom/publish'=>array('fromUserId','toChatroomId','objectName','content'),
         //   '/message/broadcast'=>array('fromUserId','objectName','content'), 暂时未开放
            '/message/history'=>array('date'),
            '/group/sync'=>array('userId',array('group')),
            '/group/join'=>array('userId','groupId','groupName'),
            '/group/quit'=>array('userId','groupId'),
            '/group/dismiss'=>array('userId','groupId'),
            '/group/create'=>array('userId','groupId','groupName'),
            '/chatroom/create'=>array(array('chatroom')),
            '/chatroom/destroy'=>array('chatroomId'),
            '/chatroom/query'=>array('chatroomId'),
        );
    }

}
