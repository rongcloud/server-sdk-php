<?php

class User{

	private $SendRequest;
	
	public function __construct($SendRequest) {
       		$this->SendRequest = $SendRequest;
    }

    
    /**
	 * 获取 Token 方法 
	 * 
	 * @param  userId:用户 Id，最大长度 64 字节.是用户在 App 中的唯一标识码，必须保证在同一个 App 内不重复，重复的用户 Id 将被当作是同一用户。（必传）
	 * @param  name:用户名称，最大长度 128 字节.用来在 Push 推送时显示用户的名称.用户名称，最大长度 128 字节.用来在 Push 推送时显示用户的名称。（必传）
	 * @param  portraitUri:用户头像 URI，最大长度 1024 字节.用来在 Push 推送时显示用户的头像。（必传）
	 *
	 * @return $json
	 **/
	public function getToken($userId, $name, $portraitUri) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($name))
				throw new Exception('Paramer "name" is required');
				
			if (empty($portraitUri))
				throw new Exception('Paramer "portraitUri" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'name' => $name,
    		'portraitUri' => $portraitUri
    		);
    		
    		$ret = $this->SendRequest->curl('/user/getToken.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 刷新用户信息方法 
	 * 
	 * @param  userId:用户 Id，最大长度 64 字节.是用户在 App 中的唯一标识码，必须保证在同一个 App 内不重复，重复的用户 Id 将被当作是同一用户。（必传）
	 * @param  name:用户名称，最大长度 128 字节。用来在 Push 推送时，显示用户的名称，刷新用户名称后 5 分钟内生效。（可选，提供即刷新，不提供忽略）
	 * @param  portraitUri:用户头像 URI，最大长度 1024 字节。用来在 Push 推送时显示。（可选，提供即刷新，不提供忽略）
	 *
	 * @return $json
	 **/
	public function refresh($userId, $name = '', $portraitUri = '') {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'name' => $name,
    		'portraitUri' => $portraitUri
    		);
    		
    		$ret = $this->SendRequest->curl('/user/refresh.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 检查用户在线状态 方法 
	 * 
	 * @param  userId:用户 Id，最大长度 64 字节。是用户在 App 中的唯一标识码，必须保证在同一个 App 内不重复，重复的用户 Id 将被当作是同一用户。（必传）
	 *
	 * @return $json
	 **/
	public function checkOnline($userId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
	
    		$params = array (
    		'userId' => $userId
    		);
    		
    		$ret = $this->SendRequest->curl('/user/checkOnline.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 封禁用户方法（每秒钟限 100 次） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  minute:封禁时长,单位为分钟，最大值为43200分钟。（必传）
	 *
	 * @return $json
	 **/
	public function block($userId, $minute) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($minute))
				throw new Exception('Paramer "minute" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'minute' => $minute
    		);
    		
    		$ret = $this->SendRequest->curl('/user/block.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 解除用户封禁方法（每秒钟限 100 次） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 *
	 * @return $json
	 **/
	public function unBlock($userId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
	
    		$params = array (
    		'userId' => $userId
    		);
    		
    		$ret = $this->SendRequest->curl('/user/unblock.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 获取被封禁用户方法（每秒钟限 100 次） 
	 * 
	 *
	 * @return $json
	 **/
	public function queryBlock() {
    	try{
	
    		$params = array (
    		);
    		
    		$ret = $this->SendRequest->curl('/user/block/query.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 添加用户到黑名单方法（每秒钟限 100 次） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  blackUserId:被加到黑名单的用户Id。（必传）
	 *
	 * @return $json
	 **/
	public function addBlacklist($userId, $blackUserId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($blackUserId))
				throw new Exception('Paramer "blackUserId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'blackUserId' => $blackUserId
    		);
    		
    		$ret = $this->SendRequest->curl('/user/blacklist/add.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 获取某用户的黑名单列表方法（每秒钟限 100 次） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 *
	 * @return $json
	 **/
	public function queryBlacklist($userId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
	
    		$params = array (
    		'userId' => $userId
    		);
    		
    		$ret = $this->SendRequest->curl('/user/blacklist/query.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 从黑名单中移除用户方法（每秒钟限 100 次） 
	 * 
	 * @param  userId:用户 Id。（必传）
	 * @param  blackUserId:被移除的用户Id。（必传）
	 *
	 * @return $json
	 **/
	public function removeBlacklist($userId, $blackUserId) {
    	try{
			if (empty($userId))
				throw new Exception('Paramer "userId" is required');
				
			if (empty($blackUserId))
				throw new Exception('Paramer "blackUserId" is required');
				
	
    		$params = array (
    		'userId' => $userId,
    		'blackUserId' => $blackUserId
    		);
    		
    		$ret = $this->SendRequest->curl('/user/blacklist/remove.json',$params,'urlencoded','im','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
}
?>