<?php

class SMS{

	private $SendRequest;
	
	public function __construct($SendRequest) {
       		$this->SendRequest = $SendRequest;
    }

    
    /**
	 * 获取图片验证码方法 
	 * 
	 * @param  appKey:应用Id
	 *
	 * @return $json
	 **/
	public function getImageCode($appKey) {
    	try{
			if (empty($appKey))
				throw new Exception('Paramer "appKey" is required');
				
	
    		$params = array (
    		'appKey' => $appKey
    		);
    		
    		$ret = $this->SendRequest->curl('/getImgCode.json',$params,'urlencoded','sms','GET');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 发送短信验证码方法。 
	 * 
	 * @param  mobile:接收短信验证码的目标手机号，每分钟同一手机号只能发送一次短信验证码，同一手机号 1 小时内最多发送 3 次。（必传）
	 * @param  templateId:短信模板 Id，在开发者后台->短信服务->服务设置->短信模版中获取。（必传）
	 * @param  region:手机号码所属国家区号，目前只支持中图区号 86）
	 * @param  verifyId:图片验证标识 Id ，开启图片验证功能后此参数必传，否则可以不传。在获取图片验证码方法返回值中获取。
	 * @param  verifyCode:图片验证码，开启图片验证功能后此参数必传，否则可以不传。
	 *
	 * @return $json
	 **/
	public function sendCode($mobile, $templateId, $region, $verifyId = '', $verifyCode = '') {
    	try{
			if (empty($mobile))
				throw new Exception('Paramer "mobile" is required');
				
			if (empty($templateId))
				throw new Exception('Paramer "templateId" is required');
				
			if (empty($region))
				throw new Exception('Paramer "region" is required');
				
	
    		$params = array (
    		'mobile' => $mobile,
    		'templateId' => $templateId,
    		'region' => $region,
    		'verifyId' => $verifyId,
    		'verifyCode' => $verifyCode
    		);
    		
    		$ret = $this->SendRequest->curl('/sendCode.json',$params,'urlencoded','sms','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
    /**
	 * 验证码验证方法 
	 * 
	 * @param  sessionId:短信验证码唯一标识，在发送短信验证码方法，返回值中获取。（必传）
	 * @param  code:短信验证码内容。（必传）
	 *
	 * @return $json
	 **/
	public function verifyCode($sessionId, $code) {
    	try{
			if (empty($sessionId))
				throw new Exception('Paramer "sessionId" is required');
				
			if (empty($code))
				throw new Exception('Paramer "code" is required');
				
	
    		$params = array (
    		'sessionId' => $sessionId,
    		'code' => $code
    		);
    		
    		$ret = $this->SendRequest->curl('/verifyCode.json',$params,'urlencoded','sms','POST');
    		if(empty($ret))
    			throw new Exception('bad request');
    		return $ret;
    		
    	}catch (Exception $e) {
    		print_r($e->getMessage());
    	}
   }
    
}
?>