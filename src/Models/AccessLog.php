<?php

namespace AnnaNovas\AccessLog\Models;

use Illuminate\Database\Eloquent\Model;

use AnnaNovas\AccessLog\Models\AccesslogAuthentication;
use AnnaNovas\AccessLog\Models\AccesslogGuard;
use AnnaNovas\AccessLog\Models\AccesslogIp;
use AnnaNovas\AccessLog\Models\AccesslogMethod;
use AnnaNovas\AccessLog\Models\AccesslogPath;
use AnnaNovas\AccessLog\Models\AccesslogProtocol;
use AnnaNovas\AccessLog\Models\AccesslogUseragent;

class AccessLog extends Model
{
    
    protected $fillable = [
        'accesslog_guard_id',  'accesslog_path_id', 'accesslog_protocol_id', 'url', 'fullUrl', 'accesslog_method_id', 'accesslog_authentication_id', 
        'accesslog_ip_id', 'accesslog_useragent_id', 'taggable_type', 'taggable_id', 'accesslog_header', 'accesslog_data',
    ];



    protected $dates = [
        'requested_at',
    ];

    

    public function accessGuard() {
        return $this->belongsTo(AccesslogGuard::class, 'accesslog_guard_id');
    }
    
    public function path() {
        return $this->belongsTo(AccesslogPath::class, 'accesslog_path_id');
    }
    
    public function protocol() {
        return $this->belongsTo(AccesslogProtocol::class, 'accesslog_protocol_id');
    }
    
    public function method() {
        return $this->belongsTo(AccesslogMethod::class, 'accesslog_method_id');
    }
    
    public function authentication() {
        return $this->belongsTo(AccesslogAuthentication::class, 'accesslog_authentication_id');
    }
    
    public function ip() {
        return $this->belongsTo(AccesslogIp::class, 'accesslog_ip_id');
    }
    
    public function useragent() {
        return $this->belongsTo(AccesslogUseragent::class, 'accesslog_useragent_id');
    }

    public function taggable()
    {
        return $this->morphTo();
    }
    

}
