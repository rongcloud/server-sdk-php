<?php

class Chatroom{

	private $SendRequest;
	
	public function __construct($SendRequest) {
       		$this->SendRequest = $SendRequest;
    }

    
    /**
	 * 创建聊天室方法 
	 * 
	 * @param  chatRoomInfo:id:要创建的聊天室的id；name:要创建的聊天室的name。（必传）
	 *
	 * @return $json
	 **/
	public function create($chatRoomInfo) {
    	try{
			if (empty($chatRoomInfo))
				throw new Exception('Paramer "chatRoomInfo" is required');
				
	
    		$params = array();
    			
           	foreach ($chatRoomInfo as $key => $value) {
            	$params['chatroom[' . $key . ']'] = $value;
           	}
    		
    		$ret = $this->SendRequest->curl('/chatroom/create.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 加入聊天室方法 
	 * 
	 * @param  userId:要加入聊天室的用户 Id，可提交多个，最多不超过 50 个。（必传）
	 * @param  chatroomId:要加入的聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function join($userId, $chatroomId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/join.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 查询聊天室信息方法 
	 * 
	 * @param  chatroomId:要查询的聊天室id（必传）
	 *
	 * @return $json
	 **/
	public function query($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/query.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 查询聊天室内用户方法 
	 * 
	 * @param  chatroomId:要查询的聊天室 ID。（必传）
	 * @param  count:要获取的聊天室成员数，上限为 500 ，超过 500 时最多返回 500 个成员。（必传）
	 * @param  order:加入聊天室的先后顺序， 1 为加入时间正序， 2 为加入时间倒序。（必传）
	 *
	 * @return $json
	 **/
	public function queryUser($chatroomId, $count, $order) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
			if (empty($count))
				throw new Exception('Paramer "count" is required');
				
			if (empty($order))
				throw new Exception('Paramer "order" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId,
    		'count' => $count,
    		'order' => $order
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/query.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 聊天室消息停止分发方法（可实现控制对聊天室中消息是否进行分发，停止分发后聊天室中用户发送的消息，融云服务端不会再将消息发送给聊天室中其他用户。） 
	 * 
	 * @param  chatroomId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function stopDistributionMessage($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/message/stopDistribution.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 聊天室消息恢复分发方法 
	 * 
	 * @param  chatroomId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function resumeDistributionMessage($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/message/resumeDistribution.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 添加禁言聊天室成员方法（在 App 中如果不想让某一用户在聊天室中发言时，可将此用户在聊天室中禁言，被禁言用户可以接收查看聊天室中用户聊天信息，但不能发送消息.） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  chatroomId:聊天室 Id。（必传）
	 * @param  minute:禁言时长，以分钟为单位，最大值为43200分钟。（必传）
	 *
	 * @return $json
	 **/
	public function addGagUser($userId, $chatroomId, $minute) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
			if (empty($minute))
				throw new Exception('Paramer "minute" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'chatroomId' => $chatroomId,
    		'minute' => $minute
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/gag/add.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 查询被禁言聊天室成员方法 
	 * 
	 * @param  chatroomId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function ListGagUser($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/gag/list.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 移除禁言聊天室成员方法 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  chatroomId:聊天室Id。（必传）
	 *
	 * @return $json
	 **/
	public function rollbackGagUser($userId, $chatroomId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/gag/rollback.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 添加封禁聊天室成员方法 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  chatroomId:聊天室 Id。（必传）
	 * @param  minute:封禁时长，以分钟为单位，最大值为43200分钟。（必传）
	 *
	 * @return $json
	 **/
	public function addBlockUser($userId, $chatroomId, $minute) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
			if (empty($minute))
				throw new Exception('Paramer "minute" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'chatroomId' => $chatroomId,
    		'minute' => $minute
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/block/add.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 查询被封禁聊天室成员方法 
	 * 
	 * @param  chatroomId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function getListBlockUser($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/block/list.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 移除封禁聊天室成员方法 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  chatroomId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function rollbackBlockUser($userId, $chatroomId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/block/rollback.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 添加聊天室消息优先级方法 
	 * 
	 * @param  objectName:低优先级的消息类型，每次最多提交 5 个，设置的消息类型最多不超过 20 个。（必传）
	 *
	 * @return $json
	 **/
	public function addPriority($objectName) {
    	try{
			if (empty($objectName))
				throw new Exception('Paramer "objectName" is required');
				
	
    		$params = array (
    		'objectName' => $objectName
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/message/priority/add.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 销毁聊天室方法 
	 * 
	 * @param  chatroomId:要销毁的聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function destroy($chatroomId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/destroy.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 添加聊天室白名单成员方法 
	 * 
	 * @param  chatroomId:聊天室中用户 Id，可提交多个，聊天室中白名单用户最多不超过 5 个。（必传）
	 * @param  userId:聊天室 Id。（必传）
	 *
	 * @return $json
	 **/
	public function addWhiteListUser($chatroomId, $userId) {
    	try{
			if (empty($chatroomId))
				throw new Exception('Paramer "chatroomId" is required');
				
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
	
    		$params = array (
    		'chatroomId' => $chatroomId,
    		'userId' => $userId
    		);
    		
    		$ret = $this->SendRequest->curl('/chatroom/user/whitelist/add.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
}
?>