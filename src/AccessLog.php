<?php

namespace AnnaNovas\AccessLog;



use AnnaNovas\AccessLog\Models\AccesslogAuthentication;
use AnnaNovas\AccessLog\Models\AccesslogGuard;
use AnnaNovas\AccessLog\Models\AccesslogIp;
use AnnaNovas\AccessLog\Models\AccesslogMethod;
use AnnaNovas\AccessLog\Models\AccesslogPath;
use AnnaNovas\AccessLog\Models\AccesslogProtocol;
use AnnaNovas\AccessLog\Models\AccesslogUseragent;

class AccessLog
{

    public static function getRequestGuardId($title){
        $obj = AccesslogGuard::updateOrCreate([
            'title'=>$title
        ]);
        return $obj->id;
    }
    
    
    public static function getRequestPathId($title){
        $obj = AccesslogPath::updateOrCreate([
            'title'=>$title
        ]);
        return $obj->id;
    }
    
    public static function getRequestProtocolId($title){
        $obj = AccesslogProtocol::updateOrCreate([
            'title'=>$title
        ]);
        return $obj->id;
    }


    public static function getRequestMethodId($title){
        $obj = AccesslogMethod::updateOrCreate([
            'title'=>$title
        ]);
        return $obj->id;
    }
    
    public static function getRequestAuthenticationId($title){
        if(!$title){
            return 0;
        }
        $obj = AccesslogAuthentication::updateOrCreate([
            'title'=>$title
        ]);
        return $obj->id;
    }
    
    public static function getRequestIpId($title){
        try {  
            $obj = AccesslogIp::updateOrCreate([
                'title'=>$title
            ]);
            return $obj->id;
        } catch (PDOException $e) {
            $obj = AccesslogIp::updateOrCreate([
                'title'=>$title
            ]);
            return $obj->id;
        }
        
    }
    
    public static function getRequestUseragentId($title){
        try {  
            $obj = AccesslogUseragent::updateOrCreate([
                'title'=>$title
            ]);
            return $obj->id;
        } catch (PDOException $e) {
            $obj = AccesslogUseragent::updateOrCreate([
                'title'=>$title
            ]);
            return $obj->id;
        }
        
    }



    public static function routes()
    {
        Route::get('accesslogsTest', function(){
            return 'Hello from the contact form package';
        });
    }
    
}