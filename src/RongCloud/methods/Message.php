<?php

class Message{

	private $SendRequest;
	
	public function __construct($SendRequest) {
       		$this->SendRequest = $SendRequest;
    }

    
    /**
	 * 发送单聊消息方法（一个用户向另外一个用户发送消息，单条消息最大 128k。每分钟最多发送 6000 条信息，每次发送用户上限为 1000 人，如：一次发送 1000 人时，示为 1000 条消息。） 
	 * 
	 * @param  fromUserId:发送人用户 Id。（必传）
	 * @param  toUserId:接收用户 Id，可以实现向多人发送消息，每次上限为 1000 人。（必传）
	 * @param  voiceMessage:消息。
	 * @param  pushContent:定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息。如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知。（可选）
	 * @param  pushData:针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData。（可选）
	 * @param  count:针对 iOS 平台，Push 时用来控制未读消息显示数，只有在 toUserId 为一个用户 Id 的时候有效。（可选）
	 * @param  verifyBlacklist:是否过滤发送人黑名单列表，0 表示为不过滤、 1 表示为过滤，默认为 0 不过滤。（可选）
	 * @param  isPersisted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行存储，0 表示为不存储、 1 表示为存储，默认为 1 存储消息。（可选）
	 * @param  isCounted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行未读消息计数，0 表示为不计数、 1 表示为计数，默认为 1 计数，未读消息数增加 1。（可选）
	 * @param  isIncludeSender:发送用户自已是否接收消息，0 表示为不接收，1 表示为接收，默认为 0 不接收。（可选）
	 *
	 * @return $json
	 **/
	public function publishPrivate($fromUserId, $toUserId,  $objectName, $content, $pushContent = '', $pushData = '', $count = '', $verifyBlacklist, $isPersisted, $isCounted, $isIncludeSender) {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($toUserId))
				throw new Exception('Paramer "toUserId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'toUserId' => $toUserId,
    		'objectName' => $objectName,
    		'content' => $content,
    		'pushContent' => $pushContent,
    		'pushData' => $pushData,
    		'count' => $count,
    		'verifyBlacklist' => $verifyBlacklist,
    		'isPersisted' => $isPersisted,
    		'isCounted' => $isCounted,
    		'isIncludeSender' => $isIncludeSender
    		);
    		
    		$ret = $this->SendRequest->curl('/message/private/publish.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送单聊模板消息方法（一个用户向多个用户发送不同消息内容，单条消息最大 128k。每分钟最多发送 6000 条信息，每次发送用户上限为 1000 人。） 
	 * 
	 * @param  templateMessage:单聊模版消息。
	 *
	 * @return $json
	 **/
	public function publishTemplate($templateMessage) {
    	try{
			if (empty($templateMessage))
				throw new Exception('Paramer "templateMessage" is required');
				
	
    		$params = json_decode($templateMessage,TRUE);
    		
    		$ret = $this->SendRequest->curl('/message/private/publish_template.json',$params,'json','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送系统消息方法（一个用户向一个或多个用户发送系统消息，单条消息最大 128k，会话类型为 SYSTEM。每秒钟最多发送 100 条消息，每次最多同时向 100 人发送，如：一次发送 100 人时，示为 100 条消息。） 
	 * 
	 * @param  fromUserId:发送人用户 Id。（必传）
	 * @param  toUserId:接收用户 Id，提供多个本参数可以实现向多人发送消息，上限为 1000 人。（必传）
	 * @param  txtMessage:发送消息内容（必传）
	 * @param  pushContent:如果为自定义消息，定义显示的 Push 内容，内容中定义标识通过 values 中设置的标识位内容进行替换.如消息类型为自定义不需要 Push 通知，则对应数组传空值即可。（可选）
	 * @param  pushData:针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData。如不需要 Push 功能对应数组传空值即可。（可选）
	 * @param  isPersisted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行存储，0 表示为不存储、 1 表示为存储，默认为 1 存储消息。（可选）
	 * @param  isCounted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行未读消息计数，0 表示为不计数、 1 表示为计数，默认为 1 计数，未读消息数增加 1。（可选）
	 *
	 * @return $json
	 **/
	public function PublishSystem($fromUserId, $toUserId,  $objectName, $content, $pushContent = '', $pushData = '', $isPersisted, $isCounted) {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($toUserId))
				throw new Exception('Paramer "toUserId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'toUserId' => $toUserId,
    		'objectName' => $objectName,
    		'content' => $content,
    		'pushContent' => $pushContent,
    		'pushData' => $pushData,
    		'isPersisted' => $isPersisted,
    		'isCounted' => $isCounted
    		);
    		
    		$ret = $this->SendRequest->curl('/message/system/publish.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送系统模板消息方法（一个用户向一个或多个用户发送系统消息，单条消息最大 128k，会话类型为 SYSTEM.每秒钟最多发送 100 条消息，每次最多同时向 100 人发送，如：一次发送 100 人时，示为 100 条消息。） 
	 * 
	 * @param  templateMessage:系统模版消息。
	 *
	 * @return $json
	 **/
	public function publishSystemTemplate($templateMessage) {
    	try{
			if (empty($templateMessage))
				throw new Exception('Paramer "templateMessage" is required');
				
	
    		$params = json_decode($templateMessage,TRUE);
    		
    		$ret = $this->SendRequest->curl('/message/system/publish_template.json',$params,'json','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送群组消息方法（以一个用户身份向群组发送消息，单条消息最大 128k.每秒钟最多发送 20 条消息，每次最多向 3 个群组发送，如：一次向 3 个群组发送消息，示为 3 条消息。） 
	 * 
	 * @param  fromUserId:发送人用户 Id 。（必传）
	 * @param  toGroupId:接收群Id，提供多个本参数可以实现向多群发送消息，最多不超过 3 个群组。（必传）
	 * @param  txtMessage:发送消息内容（必传）
	 * @param  pushContent:定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息. 如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知。（可选）
	 * @param  pushData:针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData。（可选）
	 * @param  isPersisted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行存储，0 表示为不存储、 1 表示为存储，默认为 1 存储消息。（可选）
	 * @param  isCounted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行未读消息计数，0 表示为不计数、 1 表示为计数，默认为 1 计数，未读消息数增加 1。（可选）
	 * @param  isIncludeSender:发送用户自已是否接收消息，0 表示为不接收，1 表示为接收，默认为 0 不接收。（可选）
	 *
	 * @return $json
	 **/
	public function publishGroup($fromUserId, $toGroupId,  $objectName, $content, $pushContent = '', $pushData = '', $isPersisted, $isCounted, $isIncludeSender) {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($toGroupId))
				throw new Exception('Paramer "toGroupId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'toGroupId' => $toGroupId,
    		'objectName' => $objectName,
    		'content' => $content,
    		'pushContent' => $pushContent,
    		'pushData' => $pushData,
    		'isPersisted' => $isPersisted,
    		'isCounted' => $isCounted,
    		'isIncludeSender' => $isIncludeSender
    		);
    		
    		$ret = $this->SendRequest->curl('/message/group/publish.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送讨论组消息方法（以一个用户身份向讨论组发送消息，单条消息最大 128k，每秒钟最多发送 20 条消息.） 
	 * 
	 * @param  fromUserId:发送人用户 Id。（必传）
	 * @param  toDiscussionId:接收讨论组 Id。（必传）
	 * @param  txtMessage:发送消息内容（必传）
	 * @param  pushContent:定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息. 如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知。（可选）
	 * @param  pushData:针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData.（可选）
	 * @param  isPersisted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行存储，0 表示为不存储、 1 表示为存储，默认为 1 存储消息.（可选）
	 * @param  isCounted:当前版本有新的自定义消息，而老版本没有该自定义消息时，老版本客户端收到消息后是否进行未读消息计数，0 表示为不计数、 1 表示为计数，默认为 1 计数，未读消息数增加 1。（可选）
	 * @param  isIncludeSender:发送用户自已是否接收消息，0 表示为不接收，1 表示为接收，默认为 0 不接收。（可选）
	 *
	 * @return $json
	 **/
	public function publishDiscussion($fromUserId, $toDiscussionId,  $objectName, $content, $pushContent = '', $pushData = '', $isPersisted, $isCounted, $isIncludeSender) {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($toDiscussionId))
				throw new Exception('Paramer "toDiscussionId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'toDiscussionId' => $toDiscussionId,
    		'objectName' => $objectName,
    		'content' => $content,
    		'pushContent' => $pushContent,
    		'pushData' => $pushData,
    		'isPersisted' => $isPersisted,
    		'isCounted' => $isCounted,
    		'isIncludeSender' => $isIncludeSender
    		);
    		
    		$ret = $this->SendRequest->curl('/message/discussion/publish.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送聊天室消息方法（一个用户向聊天室发送消息，单条消息最大 128k。每秒钟限 100 次。） 
	 * 
	 * @param  fromUserId:发送人用户 Id。（必传）
	 * @param  toChatroomId:接收聊天室Id，提供多个本参数可以实现向多个聊天室发送消息。（必传）
	 * @param  txtMessage:发送消息内容（必传）
	 *
	 * @return $json
	 **/
	public function publishChatroom($fromUserId, $toChatroomId,  $objectName, $content) {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($toChatroomId))
				throw new Exception('Paramer "toChatroomId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'toChatroomId' => $toChatroomId,
    		'objectName' => $objectName,
    		'content' => $content
    		);
    		
    		$ret = $this->SendRequest->curl('/message/chatroom/publish.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送广播消息方法（发送消息给一个应用下的所有注册用户，如用户未在线会对满足条件（绑定手机终端）的用户发送 Push 信息，单条消息最大 128k，会话类型为 SYSTEM。每小时只能发送 1 次，每天最多发送 3 次。） 
	 * 
	 * @param  fromUserId:发送人用户 Id。（必传）
	 * @param  txtMessage:文本消息。
	 * @param  pushContent:定义显示的 Push 内容，如果 objectName 为融云内置消息类型时，则发送后用户一定会收到 Push 信息. 如果为自定义消息，则 pushContent 为自定义消息显示的 Push 内容，如果不传则用户不会收到 Push 通知.（可选）
	 * @param  pushData:针对 iOS 平台为 Push 通知时附加到 payload 中，Android 客户端收到推送消息时对应字段名为 pushData。（可选）
	 * @param  os:针对操作系统发送 Push，值为 iOS 表示对 iOS 手机用户发送 Push ,为 Android 时表示对 Android 手机用户发送 Push ，如对所有用户发送 Push 信息，则不需要传 os 参数。（可选）
	 *
	 * @return $json
	 **/
	public function broadcast($fromUserId,  $objectName, $content, $pushContent = '', $pushData = '', $os = '') {
    	try{
			if (empty($fromUserId))
				throw new Exception('Paramer "fromUserId" is required');
				
			if (empty($objectName))
				throw new Exception('Paramer "$objectName" is required');
				
			if (empty($content))
				throw new Exception('Paramer "$content" is required');
				
	
    		$params = array (
    		'fromUserId' => $fromUserId,
    		'objectName' => $objectName,
    		'content' => $content,
    		'pushContent' => $pushContent,
    		'pushData' => $pushData,
    		'os' => $os
    		);
    		
    		$ret = $this->SendRequest->curl('/message/broadcast.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 消息历史记录下载地址获取 方法消息历史记录下载地址获取方法。获取 APP 内指定某天某小时内的所有会话消息记录的下载地址。（目前支持二人会话、讨论组、群组、聊天室、客服、系统通知消息历史记录下载） 
	 * 
	 * @param  date:指定北京时间某天某小时，格式为2014010101,表示：2014年1月1日凌晨1点。（必传）
	 *
	 * @return $json
	 **/
	public function getHistory($date) {
    	try{
			if (empty($date))
				throw new Exception('Paramer "date" is required');
				
	
    		$params = array (
    		'date' => $date
    		);
    		
    		$ret = $this->SendRequest->curl('/message/history.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 消息历史记录删除方法（删除 APP 内指定某天某小时内的所有会话消息记录。调用该接口返回成功后，date参数指定的某小时的消息记录文件将在随后的5-10分钟内被永久删除。） 
	 * 
	 * @param  date:指定北京时间某天某小时，格式为2014010101,表示：2014年1月1日凌晨1点。（必传）
	 *
	 * @return $json
	 **/
	public function deleteMessage($date) {
    	try{
			if (empty($date))
				throw new Exception('Paramer "date" is required');
				
	
    		$params = array (
    		'date' => $date
    		);
    		
    		$ret = $this->SendRequest->curl('/message/history/delete.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
}
?>