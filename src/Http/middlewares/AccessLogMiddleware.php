<?php

namespace AnnaNovas\AccessLog\Http\middlewares;

// use AnnaNovas\AccessLog\AccessLogFacade;
// use AnnaNovas\AccessLog\Model\AccessLog;
// use Carbon\Carbon;

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
        $userIds = [];
        // if( Auth::guard('admin')->user() ){
        //     $userIds['request_admin_id'] = Auth::guard('admin')->user()->id;
        // } 
        
        
        // ApiLogProcess::dispatch(
        //     2,
        //     $userIds,
        //     $request->path(),
        //     $request->getScheme(),
        //     $request->url(),
        //     $request->fullUrl(),
        //     // 'ajkshdgf',
        //     $request->method(),
        //     '',
        //     $request->ip(),
        //     $request->userAgent(),
        //     Carbon::now()
        // )->delay(now()->addSeconds(2));
        // dd('ll');
        // dd( auth()->guard()->getName() );
        // dd(Auth::getDefaultDriver());
        // dd(Auth::getDefaultUserProvider());
        // dd(Config::get('auth')['guards']['web']);
        // dd(Config::get('auth')['providers']['users']['model']);

        // AccessLogFacade::test1();
        // AccessLog::test1();


        // dd(Auth::user());

        // $guard = auth()->guard(); // Retrieve the guard
        // $sessionName = $guard->getName(); // Retrieve the session name for the guard
        // // The following extracts the name of the guard by disposing of the first
        // // and last sections delimited by "_"
        // $parts = explode("_", $sessionName);
        // unset($parts[count($parts)-1]);
        // unset($parts[0]);
        // $guardName = implode("_",$parts);
        // dd($guardName);

        $input = [];
        $input['accesslog_guard_id'] = AnnaNovasAccessLog::getRequestGuardId( Auth::getDefaultDriver() ); 
        $input['accesslog_path_id'] = AnnaNovasAccessLog::getRequestPathId($request->path());
        $input['accesslog_protocol_id'] = AnnaNovasAccessLog::getRequestProtocolId($request->getScheme()); 
        $input['url'] = $request->url();
        $input['fullUrl'] = $request->fullUrl();
        $input['accesslog_method_id'] = AnnaNovasAccessLog::getRequestMethodId( $request->method() ); 
        $input['accesslog_authentication_id'] = AnnaNovasAccessLog::getRequestAuthenticationId( $request->has('authentication') ? $request->get('authentication') : '' );
        $input['accesslog_useragent_id'] = AnnaNovasAccessLog::getRequestUseragentId( $request->userAgent() ); 
        $input['accesslog_ip_id'] = AnnaNovasAccessLog::getRequestIpId( $request->ip() );

        if(Auth::user()){

            $input['taggable_type'] = Config::get('accesslog')['guards'][Auth::getDefaultDriver()]; 
            $input['taggable_id'] = Auth::user()->id; 

        }



        $input['request_header'] = ''; 
        $input['request_data'] = ''; 

        // dd($input);

        AccessLogModel::create(
            $input
        );

        return $next($request);
    }
}
