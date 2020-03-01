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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class AccessLogController extends Controller
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
            // $accessLogs->where('accesslog_user_id', $request->get('user'));
            // $users = $model->where('id', $request->get('user'))->pluck('phone', 'id')->all();
        }


        $models = collect(Config::get('accesslog')['guards'])->pluck('model', 'model');
        $model_fields = array_column(Config::get('accesslog')['guards'], 'title_key', 'model');
        $modelData = [];
        foreach ($models as $key => $model) {
            // $className = $request->get('model');
            // $class =  new $className;
            // $modelData[$key] = 

            if ( $request->get( 'accesslogmodel_'.Str::slug($model, '-')) ) {
                $accessLogs->where('taggable_type', $model)->where('taggable_id', $request->get( 'accesslogmodel_'.Str::slug($model, '-')) );

                // where('taggable_id', $request->get('user'))
                
                $class =  new $model;
                // dd($class);
                $modelData['accesslogmodel_'.Str::slug($model, '-')] = $class->where('id', $request->get( 'accesslogmodel_'.Str::slug($model, '-')))->pluck($model_fields[$model], 'id')->all();
            }
            else{
                $modelData['accesslogmodel_'.Str::slug($model, '-')] = [];
            }
        }

        

        if ($request->get('guard')) {
            $accessLogs->where('accesslog_guard_id', $request->get('guard'));
        }
        if ($request->get('path')) {
            $accessLogs->where('accesslog_path_id', $request->get('path'));
        }
        if ($request->get('protocol')) {
            $accessLogs->where('accesslog_protocol_id', $request->get('protocol'));
        }
        if ($request->get('method')) {
            $accessLogs->where('accesslog_method_id', $request->get('method'));
        }
        if ($request->get('custom_authentication')) {
            $accessLogs->where('accesslog_authentication_id', $request->get('custom_authentication'));
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

        

        return view('accesslog::index', compact('accessLogs', 'users', 'staffs', 'paths', 'protocols', 'methods', 'authentications', 'ips', 'useragents', 'guards', 'models', 'modelData', 'model_fields'));
        
    }


    public function searchUsers(Request $request){
        // dd($request->all());

        // $class = 'App\User';
        $class = $request->get('model');
        $model =  new $class;
        // dd($model);


        $model_fields = array_column(Config::get('accesslog')['guards'], 'title_key', 'model');
        // dd($model_fields);

        $users = $model->where($model_fields[$class], 'like', '%'.$request->get('search').'%')->pluck($model_fields[$class], 'id')->all();

        $final = [];

        foreach ($users as $key => $user) {
            $final[] = ['id' => $key, 'text' => $user];
        }

        $data = [
            'results' => $final
        ];

        return response()->json($data);
    }


}
