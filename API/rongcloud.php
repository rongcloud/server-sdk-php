<?php
include 'SendRequest.php';
include 'methods/User.php';
include 'methods/Message.php';
include 'methods/Wordfilter.php';
include 'methods/Group.php';
include 'methods/Chatroom.php';
include 'methods/Push.php';
include 'methods/SMS.php';
    
class RongCloud
{
    /**
     * 参数初始化
     * @param $appKey
     * @param $appSecret
     * @param string $format
     */
    public function __construct($appKey, $appSecret, $format = 'json') {
        $this->SendRequest = new SendRequest($appKey, $appSecret, $format);
    }
    
    public function User() {
        $User = new User($this->SendRequest);
        return $User;
    }
    
    public function Message() {
        $Message = new Message($this->SendRequest);
        return $Message;
    }
    
    public function Wordfilter() {
        $Wordfilter = new Wordfilter($this->SendRequest);
        return $Wordfilter;
    }
    
    public function Group() {
        $Group = new Group($this->SendRequest);
        return $Group;
    }
    
    public function Chatroom() {
        $Chatroom = new Chatroom($this->SendRequest);
        return $Chatroom;
    }
    
    public function Push() {
        $Push = new Push($this->SendRequest);
        return $Push;
    }
    
    public function SMS() {
        $SMS = new SMS($this->SendRequest);
        return $SMS;
    }
    
}