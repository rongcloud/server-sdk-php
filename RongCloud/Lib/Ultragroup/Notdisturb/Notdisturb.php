<?php
namespace RongCloud\Lib\Ultragroup\Notdisturb;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;

/**
 * 超级群免打扰
 */
class Notdisturb {
    /**
     * 超级群模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Ultragroup/Notdisturb/';

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
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
     * 设置超级群免打扰
     *
     * @param $Group array 添加超级群禁言 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//超级群 id
            'busChannel'=> 'busid',//频道 id  可以为空
            'unpushLevel'=> -1,//超级群 免打扰级别
 *                           -1：全部消息通知
                            0：未设置（用户未设置时为此状态，为全部消息都通知，在此状态下，如设置了超级群默认状态以超级群的默认设置为准）
                            1：仅针对 @ 消息进行通知，包括 @指定用户 和 @所有人
                            2：仅针对 @ 指定用户消息进行通知，且仅通知被 @ 的指定的用户进行通知。
                            如：@张三 则张三可以收到推送，@所有人 时不会收到推送。

                            4：仅针对 @群全员进行通知，只接收 @所有人 的推送信息
                            5：不接收通知，即使为 @ 消息也不推送通知。
    ];
     * @return array
     */
    public function set(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 查询超级群/频道免打扰状态
     *
     * @param $Group array 超级群 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//超级群 id
            'busChannel'=> 'busid',//频道 id  可以为空
    ];
     * @return array
     */
    public function get(array $Group=[]){
        $conf = $this->conf['get'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

}