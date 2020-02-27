<?php

namespace AnnaNovas\AccessLog\Http\Controllers;

use AnnaNovas\AccessLog\Models\AccessLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use AnnaNovas\AccessLog\Models\AccesslogAuthentication;
use AnnaNovas\AccessLog\Models\AccesslogGuard;
use AnnaNovas\AccessLog\Models\AccesslogIp;
use AnnaNovas\AccessLog\Models\AccesslogMethod;
use AnnaNovas\AccessLog\Models\AccesslogPath;
use AnnaNovas\AccessLog\Models\AccesslogProtocol;
use AnnaNovas\AccessLog\Models\AccesslogUseragent;

class AccessLogController
{
    public function test()
    {
        return 'Hello from the controller';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            
        $accessLogs = AccessLog::orderBy('id', 'DESC');

        $users = [];
        $staffs = [];
        if ($request->get('user')) {
            $accessLogs->where('accesslog_user_id', $request->get('user'));
            $users = User::where('id', $request->get('user'))->pluck('phone', 'id')->all();
        }

        

        // if ($request->get('route')) {
        //     $accessLogs->where('route', $request->get('route'));
        // }
        if ($request->get('path')) {
            $accessLogs->where('accesslog_path_id', $request->get('path'));
        }
        if ($request->get('protocol')) {
            $accessLogs->where('accesslog_protocol_id', $request->get('protocol'));
        }
        if ($request->get('method')) {
            $accessLogs->where('accesslog_method_id', $request->get('method'));
        }
        if ($request->get('authentication')) {
            $accessLogs->where('accesslog_authentication_id', $request->get('authentication'));
        }
        if ($request->get('ip')) {
            $accessLogs->where('accesslog_ip_id', $request->get('ip'));
        }
        if ($request->get('useragent')) {
            $accessLogs->where('accesslog_useragent_id', $request->get('useragent'));
        }
        
        if ($request->get('datefrom')) {
            $accessLogs->whereDate('requested_at', '>=',$request->get('datefrom'));
        }
        
        if ($request->get('dateto')) {
            $accessLogs->whereDate('requested_at', '<=',$request->get('dateto'));
        }

        $accessLogs = $accessLogs->with('path', 'protocol', 'method', 'ip', 'authentication', 'useragent')->paginate(100);
        
        $paths = AccesslogPath::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $protocols = AccesslogProtocol::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $methods = AccesslogMethod::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $authentications = AccesslogAuthentication::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $ips = AccesslogIp::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $useragents = AccesslogUseragent::orderBy('title', 'ASC')->pluck('title', 'id')->all();
        $guards = AccesslogGuard::orderBy('title', 'ASC')->pluck('title', 'id')->all();

        return view('accesslog::index', compact('accessLogs', 'users', 'staffs', 'paths', 'protocols', 'methods', 'authentications', 'ips', 'useragents', 'guards'));
        
    }


}
