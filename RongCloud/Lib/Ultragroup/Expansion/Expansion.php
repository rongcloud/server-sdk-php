<?php

/**
 * 超级群消息扩展
 */

namespace RongCloud\Lib\Ultragroup\Expansion;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

class Expansion
{

    /**
     * @var string 消息扩展
     */
    private $jsonPath = 'Lib/Ultragroup/Expansion/';

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
     * Person constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath . 'api.json');
        $this->verify = Utils::getJson($this->jsonPath . '../verify.json');;
    }

    /**
     * 设置消息扩展
     * 
     * @param $param array 设置消息扩展参数
     * @param
     * $param = [
            'msgUID'            => 'BRGM-DEN2-01E4-BN66',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
            'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
            'groupId'          => 'tjw3zbMrU',             //群id
            'busChannel'  => '',                     //buschannel
            'extraKeyVal'       => ['type'=>'3']            //消息自定义扩展内容，JSON 结构，以 Key、Value 的方式进行设置，如：{"type":"3"}，单条消息可设置 300 个扩展信息，一次最多可以设置 100 个。
        ];
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
     * 删除消息扩展
     * 
     * @param $param array 删除消息扩展参数
     * @param
     * $param = [
            'msgUID'            => 'BRGM-DEN2-01E4-BN66',   //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
            'userId'            => 'WNYZbMqpH',             //需要设置扩展的消息发送用户 Id。
            'groupId'          => 'tjw3zbMrU',             //超级群id
            'conversationType'  => '1',                     //会话类型，二人会话是 1 、群组会话是 3，只支持单聊、群组会话类型。
            'extraKey'          => ['type']                 //需要删除的扩展信息的 Key 值，一次最多可以删除 100 个扩展信息
            'busChannel         => ""                       //buschannel 可以为空
       ];
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
     * 获取扩展信息
     * 
     * @param $param array 获取扩展信息参数
     * @param
     * $param = [
            'msgUID' => 'ujadk90ha', //消息唯一标识 ID，服务端可通过全量消息路由功能获取。
            'pageNo' => 1          //页数，默认返回 300 个扩展信息。
        ];
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
