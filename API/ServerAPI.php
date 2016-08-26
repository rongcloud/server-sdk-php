<?php

/**
 * 融云server API 接口 新版 1.0
 * Class ServerAPI
 * @author  caolong
 * @date    2014-12-10  15:30
 * @modify  2015-02-02  10:21
 *
//使用
$p = new ServerAPI('appKey','AppSecret');
$r = $p->getToken('11','22','33');
print_r($r);
 */

class ServerAPI{
    private $appKey;                //appKey
    private $appSecret;             //secret
    const   SERVERAPIURL = 'http://api.cn.ronghub.com';    //IM服务地址
    const   SMSURL = 'http://api.sms.ronghub.com';          //短信服务地址
    private $format;                //数据格式 json/xml


    /**
     * 参数初始化
     * @param $appKey
     * @param $appSecret
     * @param string $format
     */
    public function __construct($appKey,$appSecret,$format = 'json'){
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->format = $format;
    }

    /**
     * 获取 Token 方法
     * @param $userId   用户 Id，最大长度 32 字节。是用户在 App 中的唯一标识码，必须保证在同一个 App 内不重复，重复的用户 Id 将被当作是同一用户。
     * @param $name     用户名称，最大长度 128 字节。用来在 Push 推送时，或者客户端没有提供用户信息时，显示用户的名称。
     * @param $portraitUri  用户头像 URI，最大长度 1024 字节。
     * @return json|xml
     */
    public function getToken($userId, $name, $portraitUri) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($name))
                throw new Exception('用户名称 不能为空');
            if(empty($portraitUri))
                throw new Exception('用户头像 URI 不能为空');

            $ret = $this->curl('/user/getToken',array('userId'=>$userId,'name'=>$name,'portraitUri'=>$portraitUri));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 发送会话消息
     * @param $fromUserId   发送人用户 Id。（必传）
     * @param $toUserId     接收用户 Id，提供多个本参数可以实现向多人发送消息。注意：向多人发送消息时，本参数为数组（必传）
     * @param $objectName   消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content      发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent     如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData        针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @param string $count           针对 iOS 平台，Push 时用来控制未读消息显示数，只有在 toUserId 为一个用户 Id 的时候有效。(可选)
     * @param int    $verifyBlacklist 是否过滤发送人黑名单列表，0 表示为不过滤、 1 表示为过滤，默认为 0 不过滤。(可选)
     * @param int    $isPersisted     当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行存储，0 表示为不存储、 1 表示为存储，默认为 1 存储消息。(可选)
     * @param int    $isCounted       当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行未读消息计数，0 表示为不计数、 1 表示为计数，默认为 1 计数，未读消息数增加 1。(可选)
     * @return json|xml
     */
    public function messagePrivatePublish($fromUserId,$toUserId, $objectName, $content, $pushContent='', $pushData = '',$count = NULL,$verifyBlacklist = 0,$isPersisted = 1,$isCounted = 1) {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toUserId))
                throw new Exception('接收用户 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');

            $params = array(
                'fromUserId'=>$fromUserId,
                'toUserId' => $toUserId,
                'objectName'=>$objectName,
                'content'=>$content,
                'verifyBlacklist'=>$verifyBlacklist,
                'isPersisted'=>$isPersisted,
                'isCounted'=>$isCounted
            );
            if (!empty($pushContent)) 
                $params['pushContent'] = $pushContent;
            if (!empty($pushData)) 
                $params['pushData'] = $pushData;
            if (!empty($count)) 
                $params['count'] = $count;
            $ret = $this->curl('/message/private/publish', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 发送单聊模板消息 方法
     * @param $fromUserId   发送人用户 Id。（必传）
     * @param $toUserId     接收用户 Id，提供多个本参数可以实现向多人发送消息。（必传）
     * @param $objectName   消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $values       消息内容中，标识位对应内容。（必传）
     * @param $content      发送消息内容，内容中定义标识通过 values 中设置的标识位内容进行替换，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent   如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData  针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @param $verifyBlacklist   是否过滤发送人黑名单列表，0 为不过滤、 1 为过滤，默认为 0 不过滤。(可选)
     * @return json|xml
     */
    public function messagePrivatePublishTemplate($fromUserId,array $toUserId, $objectName, $values, $content, $pushContent='', $pushData = '', $verifyBlacklist=0) {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toUserId))
                throw new Exception('接收用户 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($values))
                throw new Exception('标识位对应内容 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');
    
            $params = array(
                    'fromUserId'=>$fromUserId,
                    'toUserId' => $toUserId,
                    'objectName'=>$objectName,
                    'values'=>$values,
                    'content'=>$content,
                    'pushContent'=>$pushContent,
                    'pushData'=>$pushData,
                    'verifyBlacklist' => $verifyBlacklist,
            );
    
            $ret = $this->curl('/message/private/publish_template', $params,'json');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    /**
     * 发送系统模板消息 方法
     * @param $fromUserId   发送人用户 Id。（必传）
     * @param $toUserId     接收用户 Id，提供多个本参数可以实现向多人发送消息。（必传）
     * @param $objectName   消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $values       消息内容中，标识位对应内容。（必传）
     * @param $content      发送消息内容，内容中定义标识通过 values 中设置的标识位内容进行替换，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent   如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData  针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @return json|xml
     */
    public function messageSystemPublishTemplate($fromUserId,array $toUserId, $objectName, $values, $content, $pushContent='', $pushData = '') {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toUserId))
                throw new Exception('接收用户 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($values))
                throw new Exception('标识位对应内容 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');
    
            $params = array(
                    'fromUserId'=>$fromUserId,
                    'toUserId' => $toUserId,
                    'objectName'=>$objectName,
                    'values'=>$values,
                    'content'=>$content,
                    'pushContent'=>$pushContent,
                    'pushData'=>$pushData,
            );
    
            $ret = $this->curl('/message/system/publish_template', $params,'json');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 以一个用户身份向群组发送消息
     * @param $fromUserId           发送人用户 Id。（必传）
     * @param $toGroupId             接收群Id，提供多个本参数可以实现向多群发送消息。（必传）
     * @param $objectName           消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content              发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent   如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData      针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @return json|xml
     */
    public function messageGroupPublish($fromUserId, $toGroupId = array(), $objectName, $content, $pushContent='', $pushData = '') {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toGroupId))
                throw new Exception('接收群Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');

            $params = array(
                'fromUserId'=>$fromUserId,
                'objectName'=>$objectName,
                'content'=>$content,
                'pushContent'=>$pushContent,
                'pushData'=>$pushData,
                'toGroupId' => $toGroupId
            );

            $ret = $this->curl('/message/group/publish',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 一个用户向聊天室发送消息
     * @param $fromUserId               发送人用户 Id。（必传）
     * @param $toChatroomId             接收聊天室Id，提供多个本参数可以实现向多个聊天室发送消息。（必传）
     * @param $objectName               消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content                  发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @return json|xml
     */
    public function messageChatroomPublish($fromUserId, $toChatroomId = array(), $objectName, $content) {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toChatroomId))
                throw new Exception('接收聊天室Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');
            $params = array(
                'fromUserId' => $fromUserId,
                'objectName' => $objectName,
                'content' => $content,
                'toChatroomId' => $toChatroomId
            );

            $ret = $this->curl('/message/chatroom/publish',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 发送讨论组消息
     * @param $fromUserId               发送人用户 Id。（必传）
     * @param $toDiscussionId             接收讨论组 Id。（必传）
     * @param $objectName               消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content                  发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent   如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData  针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @return json|xml
     */
    public function messageDiscussionPublish($fromUserId,$toDiscussionId,$objectName,$content,$pushContent='',$pushData='') {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toDiscussionId))
                throw new Exception('接收讨论组 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');
    
            $params = array(
                    'fromUserId'=>$fromUserId,
                    'toDiscussionId'=>$toDiscussionId,
                    'objectName'=>$objectName,
                    'content'=>$content,
                    'pushContent'=>$pushContent,
                    'pushData'=>$pushData
            );
            $paramsString = http_build_query($params);
            $ret = $this->curl('/message/discussion/publish',$paramsString);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 一个用户向一个或多个用户发送系统消息
     * @param $fromUserId       发送人用户 Id。（必传）
     * @param $toUserId         接收用户Id，提供多个本参数可以实现向多用户发送系统消息。（必传）
     * @param $objectName       消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content          发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param string $pushContent   如果为自定义消息，定义显示的 Push 内容。(可选)
     * @param string $pushData  针对 iOS 平台，Push 通知附加的 payload 字段，字段名为 appData。(可选)
     * @return json|xml
     */
    public function messageSystemPublish($fromUserId,$toUserId = array(),$objectName,$content,$pushContent='',$pushData = '') {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($toUserId))
                throw new Exception('接收用户 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型 不能为空');
            if(empty($content))
                throw new Exception('发送消息内容 不能为空');

            $params = array(
                'fromUserId' => $fromUserId,
                'objectName' => $objectName,
                'content' => $content,
                'pushContent' => $pushContent,
                'pushData' => $pushData,
                'toUserId' => $toUserId
            );

            $ret = $this->curl('/message/system/publish',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 某发送消息给一个应用下的所有注册用户。
     * @param $fromUserId       发送人用户 Id。（必传）
     * @param $objectName       消息类型，参考融云消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $content          发送消息内容，参考融云消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param $pushContent      定义显示的 Push 内容 (可选)
     * @param $pushData         针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData。(可选)
     * @param $os               针对操作系统发送 Push (可选)
     * @return json|xml
     */
    public function messageBroadcast($fromUserId,$objectName,$content,$pushContent = NULL,$pushData = NULL,$os = NULL) {
        try{
            if(empty($fromUserId))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($objectName))
                throw new Exception('消息类型不能为空');
            if(empty($content))
                throw new Exception('发送消息内容不能为空');
            
            $params['fromUserId'] = $fromUserId;
            $params['objectName'] = $objectName;
            $params['content'] = $content;
            if (!empty($pushContent)) {
                $params['pushContent'] = $pushContent;
            }
            if (!empty($pushData)) {
                $params['pushData'] = $pushData;
            }
            if (!empty($os)) {
                $params['os'] = $os;
            }
            $ret = $this->curl('/message/broadcast',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 获取 APP 内指定某天某小时内的所有会话消息记录的下载地址
     * @param $date     指定北京时间某天某小时，格式为：2014010101,表示：2014年1月1日凌晨1点。（必传）
     * @return json|xml
     */
    public function messageHistory($date) {
        try{
            if(empty($date))
                throw new Exception('时间不能为空');
            $ret = $this->curl('/message/history', array('date' => $date));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 删除 APP 内指定某天某小时内的所有会话消息记录
     * @param $date string 指定北京时间某天某小时，格式为2014010101,表示：2014年1月1日凌晨1点。（必传）
     * @return mixed
     */
    public function messageHistoryDelete($date) {
        try{
            if(empty($date))
                throw new Exception('时间 不能为空');
            $ret = $this->curl('/message/history/delete', array('date' => $date));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 向融云服务器提交 userId 对应的用户当前所加入的所有群组。
     * @param $userId           被同步群信息的用户Id。（必传）
     * @param array $data       该用户的群信息。（必传）array('key'=>'val')
     * @return json|xml
     */
    public function groupSync($userId, $data = array()) {
        try{
            if(empty($userId))
                throw new Exception('被同步群信息的用户 Id 不能为空');
            if(empty($data))
                throw new Exception('该用户的群信息 不能为空');
            $arrKey = array_keys($data);
            $arrVal = array_values($data);
            $params = array(
                'userId' => $userId
            );
            foreach ($data as $key => $value) {
                $params['group[' . $key . ']'] = $value;
            }

            $ret = $this->curl('/group/sync', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 将用户加入指定群组，用户将可以收到该群的消息。
     * @param $userId           要加入群的用户 Id。（必传）
     * @param $groupId          要加入的群 Id。（必传）
     * @param $groupName        要加入的群 Id 对应的名称。（必传）
     * @return json|xml
     */
    public function groupJoin($userId, $groupId, $groupName) {
        try{
            if(empty($userId))
                throw new Exception('被同步群信息的用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('加入的群 Id 不能为空');
            if(empty($groupName))
                throw new Exception('加入的群 Id 对应的名称不能为空');
            $ret = $this->curl('/group/join',
                array(
                    'userId' => $userId,
                    'groupId' => $groupId,
                    'groupName' => $groupName
                )
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 将用户从群中移除，不再接收该群组的消息。
     * @param $userId       要退出群的用户 Id。（必传）
     * @param $groupId      要退出的群 Id。（必传）
     * @return mixed
     */
    public function groupQuit($userId, $groupId) {
        try{
            if(empty($userId))
                throw new Exception('被同步群信息的用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('加入的群 Id 不能为空');
            $ret = $this->curl('/group/quit',
                array('userId' => $userId, "groupId" => $groupId)
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 解散群组方法  将该群解散，所有用户都无法再接收该群的消息。
     * @param $userId           操作解散群的用户 Id。（必传）
     * @param $groupId          要解散的群 Id。（必传）
     * @return mixed
     */
    public function groupDismiss($userId, $groupId) {
        try{
            if(empty($userId))
                throw new Exception('操作解散群的用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('要解散的群 Id 不能为空');
            $ret = $this->curl('/group/dismiss',
                array('userId' => $userId, "groupId" => $groupId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 创建群组，并将用户加入该群组，用户将可以收到该群的消息。注：其实本方法是加入群组方法 /group/join 的别名。
     * @param $userId       要加入群的用户 Id。（必传）
     * @param $groupId      要加入的群 Id。（必传）
     * @param $groupName    要加入的群 Id 对应的名称。（可选）
     * @return json|xml
     */
    public function groupCreate(array $userId, $groupId, $groupName) {
        try{
            if(empty($userId))
                throw new Exception('要加入群的用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('要加入的群 Id 不能为空');
            if(empty($groupName))
                throw new Exception('要加入的群 Id 对应的名称 不能为空');
            $ret = $this->curl('/group/create',
                array('userId' => $userId, 'groupId' => $groupId,'groupName' => $groupName)
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 刷新群组信息 方法
     * @param $groupId      群组 Id。（必传）
     * @param $groupName    群组名称。（必传）
     * @return json|xml
     */
    public function groupRefresh($groupId, $groupName) {
        try{
            if(empty($groupId))
                throw new Exception('群组 Id 不能为空');
            if(empty($groupName))
                throw new Exception('群组名称 不能为空');
            $ret = $this->curl('/group/refresh',
                    array('groupId' => $groupId,'groupName' => $groupName)
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 查询群成员 方法
     * @param $groupId      群 Id。（必传）
     * @return json|xml
     */
    public function groupUserQuery( $groupId ) {
        try{
            if(empty($groupId))
                throw new Exception('要加入的群 Id 不能为空');
            $ret = $this->curl('/group/user/query',
                    array('groupId' => $groupId)
            );
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 创建聊天室
     * @param array $data   key:要创建的聊天室的id；val:要创建的聊天室的name。（必传）
     * @return json|xml
     */
    public function chatroomCreate($data = array()) {
        try{
            if(empty($data))
                throw new Exception('要加入群的用户 Id 不能为空');
            $params = array();
            foreach($data as $key=>$val) {
                $k = 'chatroom['.$key.']';
                $params["$k"] = $val;
            }
            $ret = $this->curl('/chatroom/create', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 创建聊天室
     * @param array $userId   要加入聊天室的用户 Id，可提交多个，最多不超过 50 个。（必传）
     * @param array $chatroomId   要加入的聊天室 Id。（必传）
     * @return json|xml
     */
    public function chatroomJoin(array $userId,$chatroomId) {
        try{
            if(empty($userId))
                throw new Exception('要加入聊天室的用户 Id 不能为空');
            if(empty($chatroomId))
                throw new Exception('要加入聊天室 Id 不能为空');
            $params = array('userId'=>$userId,'chatroomId'=>$chatroomId);
            $ret = $this->curl('/chatroom/join', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 销毁聊天室
     * @param $chatroomId   要销毁的聊天室 Id。（必传）
     * @return json|xml
     */
    public function chatroomDestroy($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('要销毁的聊天室 Id 不能为空');
            $ret = $this->curl('/chatroom/destroy', array('chatroomId' => $chatroomId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 查询聊天室信息 方法
     * @param $chatroomId   要查询的聊天室id（必传）
     * @return json|xml
     */
    public function chatroomQuery($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('要查询的聊天室 Id 不能为空');
            $ret = $this->curl('/chatroom/query', array('chatroomId' => $chatroomId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 聊天室消息停止分发 方法
     * @param $chatroomId   要查询的聊天室id（必传）
     * @return json|xml
     */
    public function chatroomMessageStopDistribution($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('要停止分发的聊天室 Id 不能为空');
            $ret = $this->curl('/chatroom/message/stopDistribution', array('chatroomId' => $chatroomId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 聊天室消息恢复分发 方法
     * @param $chatroomId   要查询的聊天室id（必传）
     * @return json|xml
     */
    public function chatroomMessageResumeDistribution($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('要恢复分发的聊天室 Id 不能为空');
            $ret = $this->curl('/chatroom/message/resumeDistribution', array('chatroomId' => $chatroomId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 查询聊天室内用户
     * @param $chatroomId  聊天室 Id
     * @param $count       要获取的聊天室成员数，上限为 500 ，超过 500 时最多返回 500 个成员（必传）
     * @param $order       加入聊天室的先后顺序， 1 为加入时间正序， 2 为加入时间倒序（必传）
     */
    public function userChatroomQuery($chatroomId,$count = 500,$order = 1) {
        try{
            if(empty($chatroomId)) {
                throw new Exception('聊天室 Id 不能为空');
            }
            if (empty($count) || $count<1 || $order>500) {
                throw new Exception('"聊天室成员数"为0到500间的整数');
            }
            if (!in_array($order, array(1,2))) {
                throw new Exception('加入聊天室的先后顺序需要为1或2,');
            }
            $params['chatroomId'] = $chatroomId;
            $params['count'] = $count;
            $params['order'] = $order;
            $ret = $this->curl('/chatroom/user/query', $params);
            if(empty($ret)) {
                throw new Exception('请求失败');
            }
            return $ret;
        } catch(Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 检查用户在线状态 方法
     * @param $userId    用户 Id。（必传）
     * @return mixed
     */
    public function userCheckOnline($userId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            $ret = $this->curl('/user/checkOnline', array('userId' => $userId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 封禁用户 方法
     * @param $userId   用户 Id。（必传）
     * @param $minute   封禁时长,单位为分钟，最大值为43200分钟。（必传）
     * @return mixed
     */
    public function userBlock($userId,$minute) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($minute))
                throw new Exception('封禁时长不能为空');
            $ret = $this->curl('/user/block', array('userId' => $userId, 'minute' => $minute));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 解除用户封禁 方法
     * @param $userId   用户 Id。（必传）
     * @return mixed
     */
    public function userUnBlock($userId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            $ret = $this->curl('/user/unblock', array('userId' => $userId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 获取被封禁用户 方法
     * @return mixed
     */
    public function userBlockQuery() {
        try{
            $ret = $this->curl('/user/block/query','');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     *刷新用户信息 方法  说明：当您的用户昵称和头像变更时，您的 App Server 应该调用此接口刷新在融云侧保存的用户信息，以便融云发送推送消息的时候，能够正确显示用户信息
     * @param $userId   用户 Id，最大长度 32 字节。是用户在 App 中的唯一标识码，必须保证在同一个 App 内不重复，重复的用户 Id 将被当作是同一用户。（必传）
     * @param string $name  用户名称，最大长度 128 字节。用来在 Push 推送时，或者客户端没有提供用户信息时，显示用户的名称。
     * @param string $portraitUri   用户头像 URI，最大长度 1024 字节
     * @return mixed
     */
    public function userRefresh($userId,$name='',$portraitUri='') {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($name))
                throw new Exception('用户名称不能为空');
            if(empty($portraitUri))
                throw new Exception('用户头像 URI 不能为空');
            $ret = $this->curl('/user/refresh',
                array('userId' => $userId, 'name' => $name, 'portraitUri' => $portraitUri));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 添加用户到黑名单
     * @param $userId       用户 Id。（必传）
     * @param $blackUserId  被加黑的用户Id。(必传)
     * @return mixed
     */
    public function userBlacklistAdd($userId,$blackUserId = array()) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($blackUserId))
                throw new Exception('被加黑的用户 Id 不能为空');

            $params = array(
                'userId' => $userId,
                'blackUserId' => $blackUserId
            );

            $ret = $this->curl('/user/blacklist/add', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 获取某个用户的黑名单列表
     * @param $userId   用户 Id。（必传）
     * @return mixed
     */
    public function userBlacklistQuery($userId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            $ret = $this->curl('/user/blacklist/query', array('userId' => $userId));
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }


    /**
     * 从黑名单中移除用户
     * @param $userId               用户 Id。（必传）
     * @param array $blackUserId    被移除的用户Id。(必传)
     * @return mixed
     */
    public function userBlacklistRemove($userId, $blackUserId = array()) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($blackUserId))
                throw new Exception('被移除的用户 Id 不能为空');

            $params = array(
                'userId' => $userId,
                'blackUserId' => $blackUserId
            );

            $ret = $this->curl('/user/blacklist/remove', $params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }

    }
    
    /**
     * 添加禁言群成员
     * @param $userId   用户 Id。（必传）
     * @param $groupId 群组 Id。（必传）
     * @param $minute 禁言时长，以分钟为单位，可以不传此参数，默认为永久禁言。
     * @return mixed
     */
    public function groupUserGagAdd($userId,$groupId,$minute) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('群组 Id 不能为空');
            if (empty($minute))
                throw new Exception('禁言时长 不能为空');
            $params['userId'] = $userId;
            $params['groupId'] = $groupId;
            $params['minute'] = $minute;
            $ret = $this->curl('/group/user/gag/add',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    
    /**
     * 移除禁言群成员
     * @param $userId   用户 Id。（必传）
     * @param $groupId 群组 Id。（必传）
     * @return mixed
     */
    public function groupUserGagRollback($userId,$groupId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($groupId))
                throw new Exception('群组 Id 不能为空');
            $params['userId'] = $userId;
            $params['groupId'] = $groupId;
            $ret = $this->curl('/group/user/gag/rollback',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 查询被禁言群成员
     * @param $groupId 群组 Id。（必传）
     * @return mixed
     */
    public function groupUserGagList($groupId) {
        try{
            if(empty($groupId))
                throw new Exception('群组 Id 不能为空');
            $params['groupId'] = $groupId;
            $ret = $this->curl('/group/user/gag/list',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 添加敏感词
     * @param $word 敏感词，最长不超过 32 个字符。（必传）
     * @return mixed
     */
    public function wordfilterAdd($word) {
        try{
            if(empty($word))
                throw new Exception('敏感词不能为空');
            $params['word'] = $word;
            $ret = $this->curl('/wordfilter/add',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 移除敏感词
     * @param $word 敏感词，最长不超过 32 个字符。（必传）
     * @return mixed
     */
    public function wordfilterDelete($word) {
        try{
            if(empty($word))
                throw new Exception('敏感词不能为空');
            $params['word'] = $word;
            $ret = $this->curl('/wordfilter/delete',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    /**
     * 查询敏感词列表
     * @return mixed
     */
    public function wordfilterList() {
        try{
            $ret = $this->curl('/wordfilter/list',array());
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 添加禁言聊天室成员 方法
     * @param $userId 用户 Id。（必传）
     * @param $chatroomId 聊天室 Id。（必传）
     * @param $minute 禁言时长，以分钟为单位，最大值为43200分钟。（必传）
     * @return mixed
     */
    public function chatroomUserGagAdd($userId,$chatroomId,$minute) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            if(empty($minute) || intval($minute)>43200)
                throw new Exception('禁言时长不能为空,且最大值为43200');
            $params['userId'] = $userId;
            $params['chatroomId'] = $chatroomId;
            $params['minute'] = $minute;
            $ret = $this->curl('/chatroom/user/gag/add',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 移除禁言聊天室成员 方法
     * @param $userId 用户 Id。（必传）
     * @param $chatroomId 聊天室 Id。（必传）
     * @return mixed
     */
    public function chatroomUserGagRollback($userId,$chatroomId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            $params['userId'] = $userId;
            $params['chatroomId'] = $chatroomId;
            $ret = $this->curl('/chatroom/user/gag/rollback',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    /**
     * 查询被禁言聊天室成员 方法
     * @param $chatroomId 聊天室 Id。（必传）
     * @return mixed
     */
    public function chatroomUserGagList($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            $params['chatroomId'] = $chatroomId;
            $ret = $this->curl('/chatroom/user/gag/list',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 添加封禁聊天室成员 方法
     * @param $userId 用户 Id。（必传）
     * @param $chatroomId 聊天室 Id。（必传）
     * @param $minute 封禁时长，以分钟为单位，最大值为43200分钟。（必传）
     * @return mixed
     */
    public function chatroomUserBlockAdd($userId,$chatroomId,$minute) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            if(empty($minute) || intval($minute)>43200)
                throw new Exception('封禁时长不能为空,且最大值为43200');
            $params['userId'] = $userId;
            $params['chatroomId'] = $chatroomId;
            $params['minute'] = $minute;
            $ret = $this->curl('/chatroom/user/block/add',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 移除封禁聊天室成员 方法
     * @param $userId 用户 Id。（必传）
     * @param $chatroomId 聊天室 Id。（必传）
     * @return mixed
     */
    public function chatroomUserBlockRollback($userId,$chatroomId) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            $params['userId'] = $userId;
            $params['chatroomId'] = $chatroomId;
            $ret = $this->curl('/chatroom/user/block/rollback',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    /**
     * 查询被封禁聊天室成员 方法
     * @param $chatroomId 聊天室 Id。（必传）
     * @return mixed
     */
    public function chatroomUserBlockList($chatroomId) {
        try{
            if(empty($chatroomId))
                throw new Exception('聊天室 Id 不能为空');
            $params['chatroomId'] = $chatroomId;
            $ret = $this->curl('/chatroom/user/block/list',$params);
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 推送服务 添加标签 方法
     * @param string $userId 用户 Id。（必传）
     * @param array $tags 用户标签，一个用户最多添加 20 个标签，每个 tags 最大不能超过 40 个字节，标签中不能包含特殊字符。（必传）
     * @return mixed
     */
    public function pushUserTagSet($userId,array $tags) {
        try{
            if(empty($userId))
                throw new Exception('用户 Id 不能为空');
            if(empty($tags))
                throw new Exception('用户标签不能为空');
            $params['userId'] = $userId;
            $params['tags'] = $tags;
            $ret = $this->curl('/user/tag/set',$params,'json');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * 推送服务 推送 方法
     * @param $platform 目标操作系统，ios、android 最少传递一个。如果需要给两个系统推送消息时，则需要全部填写。（必传）
     * @param $audience 推送条件，包括： tag 、 userid 、 is_to_all。（必传）
     * @param $audience[ tag ] 用户标签，每次发送时最多发送 20 个标签，标签之间为与的关系，is_to_all 为 true 时可不传。（非必传）
     * @param $audience[ userid ] 用户 Id，每次发送时最多发送 1000 个用户，如果 tag 和 userid 两个条件同时存在时，则以 userid 为准，如果 userid 有值时，则 platform 参数无效，is_to_all 为 true 时可不传。（非必传）
     * @param $audience[ is_to_all ] 是否全部推送，false 表示按 tag 或 userid 条件推送，true 表示向所有用户推送，tag 和 userid 两个条件无效。（必传）
     * @param $notification 按操作系统类型推送消息内容，如 platform 中设置了给 ios 和 android 系统推送消息，而在 notifications 中只设置了 ios 的推送内容，则 android 的推送内容为最初 alert 设置的内容。（非必传）
     * @param $notification[ alert ] 	默认推送消息内容，如填写了 ios 或 android 下的 alert 时，则推送内容以对应平台系统的 alert 为准。（必传）
     * @param $notification[ ios ] 设置 iOS 平台下的推送及附加信息。（非必传）
     * @param $notification[ android ] 设置 Android 平台下的推送及附加信息。（非必传）
     * @param $notification[ ios ][ alert ] ios平台下的推送消息内容，传入后默认的推送消息内容失效，不能为空。（非必传）
     * @param $notification[ ios ][ extras ]  ios平台下的附加信息，如果开发者自己需要，可以自己在 App 端进行解析。（非必传）
     * @param $notification[ android ][ alert ] android平台下的推送消息内容，传入后默认的推送消息内容失效，不能为空。（非必传）
     * @param $notification[ android ][ extras ]  android平台下的附加信息，如果开发者自己需要，可以自己在 App 端进行解析。（非必传）
     * @return mixed
     */
    public function push( $platform,$audience,$notification ) {
        try{
            if(empty($platform))
                throw new Exception('目标操作系统，ios、android 最少传递一个');
            if(empty($audience))
                throw new Exception('推送条件不能为空');
            if( !isset($audience['is_to_all']) )
                throw new Exception('是否全部推送不能为空');
            if(empty($notification))
                throw new Exception('推送消息内容不能为空');
            if(empty($notification['alert']))
                throw new Exception('	默认推送消息内容不能为空');
            $params['platform'] = $platform;
            $params['audience'] = $audience;
            $params['notification'] = $notification;
            $ret = $this->curl('/push',$params,'json');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 推送服务 推送消息 方法
     * @param $platform 目标操作系统，ios、android 最少传递一个。如果需要给两个系统推送消息时，则需要全部填写。（必传）
     * @param $fromuserid  发送人用户 Id。（必传）
     * @param $audience 推送条件，包括： tag 、 userid 、 is_to_all。（必传）
     * @param $audience[ tag ] 用户标签，每次发送时最多发送 20 个标签，标签之间为与的关系，is_to_all 为 true 时可不传。（非必传）
     * @param $audience[ userid ] 用户 Id，每次发送时最多发送 1000 个用户，如果 tag 和 userid 两个条件同时存在时，则以 userid 为准，如果 userid 有值时，则 platform 参数无效，is_to_all 为 true 时可不传。（非必传）
     * @param $audience[ is_to_all ] 是否全部推送，false 表示按 tag 或 userid 条件推送，true 表示向所有用户推送，tag 和 userid 两个条件无效。（必传）
     * @param $message[ content ]  发送消息内容，参考融云 Server API 消息类型表.示例说明；如果 objectName 为自定义消息类型，该参数可自定义格式。（必传）
     * @param $message[ objectName ]  消息类型，参考融云 Server API 消息类型表.消息标志；可自定义消息类型。（必传）
     * @param $notification 按操作系统类型推送消息内容，如 platform 中设置了给 ios 和 android 系统推送消息，而在 notifications 中只设置了 ios 的推送内容，则 android 的推送内容为最初 alert 设置的内容。（非必传）
     * @param $notification[ alert ] 	默认推送消息内容，如填写了 ios 或 android 下的 alert 时，则推送内容以对应平台系统的 alert 为准。（必传）
     * @param $notification[ ios ] 设置 iOS 平台下的推送及附加信息。（非必传）
     * @param $notification[ android ] 设置 Android 平台下的推送及附加信息。（非必传）
     * @param $notification[ ios ][ alert ] ios平台下的推送消息内容，传入后默认的推送消息内容失效，不能为空。（非必传）
     * @param $notification[ ios ][ extras ]  ios平台下的附加信息，如果开发者自己需要，可以自己在 App 端进行解析。（非必传）
     * @param $notification[ android ][ alert ] android平台下的推送消息内容，传入后默认的推送消息内容失效，不能为空。（非必传）
     * @param $notification[ android ][ extras ]  android平台下的附加信息，如果开发者自己需要，可以自己在 App 端进行解析。（非必传）
     * @return mixed
     */
    public function pushMessage( $platform,$fromuserid,$audience,$message,$notification ) {
        try{
            if(empty($platform))
                throw new Exception('目标操作系统，ios、android 最少传递一个');
            if(empty($fromuserid))
                throw new Exception('发送人用户 Id 不能为空');
            if(empty($audience))
                throw new Exception('推送条件不能为空');
            if(empty($message))
                throw new Exception('消息内容不能为空');
            if(empty($message['content']))
                throw new Exception('发送消息内容不能为空');
            if(empty($message['objectName']))
                throw new Exception('消息类型不能为空');
            if(empty($notification))
                throw new Exception('推送消息内容不能为空');
            if(empty($notification['alert']))
                throw new Exception('	默认推送消息内容不能为空');
            
            $message['content'] = json_encode($message['content']);
            $params['platform'] = $platform;
            $params['fromuserid'] = $fromuserid;
            $params['audience'] = $audience;
            $params['message'] = $message;
            $params['notification'] = $notification;
            $ret = $this->curl('/push',$params,'json');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 获取图片验证码 方法
     * @return mixed
     */
    public function smsGetImgCode() {
        try{
            $params['appKey'] = $this->appKey;
            $ret = $this->curl('/getImgCode',$params,'urlencoded','sms','GET');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 发送短信验证码 方法
     * @param $mobile     接收短信验证码的目标手机号，每分钟同一手机号只能发送一次短信验证码，同一手机号 1 小时内最多发送 3 次。（必传）
     * @param $templateId 短信模板 Id，在开发者后台->短信服务->服务设置->短信模版中获取。（必传）
     * @param $verifyId   图片验证标识 Id ，开启图片验证功能后此参数必传，否则可以不传。在获取图片验证码方法返回值中获取。
     * @param $verifyCode 图片验证码，开启图片验证功能后此参数必传，否则可以不传。
     * @param $region     手机号码所属国家区号，目前只支持中国区号 86
     * @return mixed
     */
    public function smsSendCode($mobile,$templateId,$verifyId = NULL,$verifyCode = NULL,$region='86') {
        try{
            if(empty($mobile))
                throw new Exception('手机号不能为空');
            if(empty($templateId))
                throw new Exception('短信模板 Id 不能为空');

            $params['mobile'] = $mobile;
            $params['templateId'] = $templateId;
            if (!empty($verifyId)) 
                $params['verifyId'] = $verifyId;
            if (!empty($verifyCode)) 
                $params['verifyCode'] = $verifyCode;
            $params['region'] = $region;
            
            $ret = $this->curl('/sendCode',$params,'urlencoded','sms','POST');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
    
    /**
     * 验证码验证 方法
     * @param $sessionId 短信验证码唯一标识，在发送短信验证码方法，返回值中获取。（必传）
     * @param $code      短信验证码内容。（必传）
     * @return mixed
     */
    public function smsVerifyCode($sessionId,$code) {
        try{
            if(empty($sessionId))
                throw new Exception('验证码唯一标识不能为空');
            if(empty($code))
                throw new Exception('验证码不能为空');

            $params['sessionId'] = $sessionId;
            $params['code'] = $code;
            
            $ret = $this->curl('/verifyCode',$params,'urlencoded','sms','POST');
            if(empty($ret))
                throw new Exception('请求失败');
            return $ret;
        }catch (Exception $e) {
            print_r($e->getMessage());
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
        return array(
            'RC-App-Key:'.$this->appKey,
            'RC-Nonce:'.$nonce,
            'RC-Timestamp:'.$timeStamp,
            'RC-Signature:'.$sign,
        );
    }

    /**
     * 重写实现 http_build_query 提交实现(同名key)key=val1&key=val2
     * @param array $formData 数据数组
     * @param string $numericPrefix 数字索引时附加的Key前缀
     * @param string $argSeparator 参数分隔符(默认为&)
     * @param string $prefixKey Key 数组参数，实现同名方式调用接口
     * @return string
     */
    private function build_query($formData, $numericPrefix = '', $argSeparator = '&', $prefixKey = '') {
        $str = '';
        foreach ($formData as $key => $val) {
            if (!is_array($val)) {
                $str .= $argSeparator;
                if ($prefixKey === '') {
                    if (is_int($key)) {
                        $str .= $numericPrefix;
                    }
                    $str .= urlencode($key) . '=' . urlencode($val);
                } else {
                    $str .= urlencode($prefixKey) . '=' . urlencode($val);
                }
            } else {
                if ($prefixKey == '') {
                    $prefixKey .= $key;
                }
                if (is_array($val[0])) {
                    $arr = array();
                    $arr[$key] = $val[0];
                    $str .= $argSeparator . http_build_query($arr);
                } else {
                    $str .= $argSeparator . $this->build_query($val, $numericPrefix, $argSeparator, $prefixKey);
                }
                $prefixKey = '';
            }
        }
        return substr($str, strlen($argSeparator));
    }

    /**
     * 发起 server 请求
     * @param $action
     * @param $params
     * @param $httpHeader
     * @return mixed
     */
    public function curl($action, $params,$contentType='urlencoded',$module = 'im',$httpMethod='POST') {
        switch ($module){
            case 'im':
                $action = self::SERVERAPIURL.$action.'.'.$this->format;
                break;
            case 'sms':
                $action = self::SMSURL.$action.'.json';
                break;
            default:
                $action = self::SERVERAPIURL.$action.'.'.$this->format;
        }
        $httpHeader = $this->createHttpHeader();
        $ch = curl_init();
        if ($httpMethod=='POST' && $contentType=='urlencoded') {
            $httpHeader[] = 'Content-Type:application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->build_query($params));
        }
        if ($httpMethod=='POST' && $contentType=='json') {
            $httpHeader[] = 'Content-Type:Application/json';
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params) );
        }
        if ($httpMethod=='GET' && $contentType=='urlencoded') {
            $action .= strpos($action, '?') === false?'?':'&';
            $action .= $this->build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $action);
        curl_setopt($ch, CURLOPT_POST, $httpMethod=='POST');
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
}
