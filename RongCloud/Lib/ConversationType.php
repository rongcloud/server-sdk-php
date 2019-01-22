<?php
/**
 * 会话类型
 */
namespace RongCloud\Lib;

class ConversationType{
    static function t(){
        return $Conversation = [
            'PRIVATE'=> 1,
            'DISCUSSION'=> 2,
            'GROUP'=> 3,
            'CUSTOMER_SERVICE'=> 5,
            'SYSTEM'=> 6,
            'APP_PUBLIC'=> 7,
            'PUBLIC'=> 8
        ];
    }
}

