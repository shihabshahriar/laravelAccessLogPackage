<?php

namespace AnnaNovas\AccessLog\Http\middlewares;

use AnnaNovas\AccessLog\AccessLog;
use AnnaNovas\AccessLog\Facades\AccessLog as AnnaNovasAccessLog;
use AnnaNovas\AccessLog\Models\AccessLog as AccessLogModel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AccessLogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

        if( Config::get('accesslog')['skip_url_paths'] && is_array(Config::get('accesslog')['skip_url_paths']) && in_array($request->path(), Config::get('accesslog')['skip_url_paths']) ){
            return $next($request);
        }
        $input = [];
        $input['accesslog_guard_id'] = AnnaNovasAccessLog::getRequestGuardId( Auth::getDefaultDriver() ); 
        $input['accesslog_path_id'] = AnnaNovasAccessLog::getRequestPathId($request->path());
        $input['accesslog_protocol_id'] = AnnaNovasAccessLog::getRequestProtocolId($request->getScheme()); 
        $input['url'] = $request->url();
        $input['fullUrl'] = $request->fullUrl();
        $input['accesslog_method_id'] = AnnaNovasAccessLog::getRequestMethodId( $request->method() ); 

        if( Config::get('accesslog')['custom_authentication'] ){
            $input['accesslog_authentication_id'] = AnnaNovasAccessLog::getRequestAuthenticationId( $request->has( Config::get('accesslog')['custom_authentication']) ? $request->get(Config::get('accesslog')['custom_authentication']) : null );
        }
        else{
            $input['accesslog_authentication_id'] = 0;
        }
        $input['accesslog_useragent_id'] = AnnaNovasAccessLog::getRequestUseragentId( $request->userAgent() ); 
        $input['accesslog_ip_id'] = AnnaNovasAccessLog::getRequestIpId( $request->ip() );

        if( Auth::user() && isset(Config::get('accesslog')['guards'][Auth::getDefaultDriver()]) ){

            $input['taggable_type'] = Config::get('accesslog')['guards'][Auth::getDefaultDriver()]['model']; 
            $input['taggable_id'] = Auth::user()->id; 

        }



        $input['request_header'] = ''; 
        $input['request_data'] = ''; 


        AccessLogModel::create(
            $input
        );

        return $next($request);
    }
}
