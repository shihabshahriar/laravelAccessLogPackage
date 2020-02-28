<?php

return [

    
    /*
    |--------------------------------------------------------------------------
    | Authentication Guards Models for taggable morphs
    |--------------------------------------------------------------------------
    */
    'guards' => [
        'web' => [
            'model'=>'App\User',
            'title_key'=>'name',
        ],
        'api' => [
            'model'=>'App\User',
            'title_key'=>'name',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | routes want to skip : 'path/to/your/route'
    |--------------------------------------------------------------------------
    */
    'skip_url_paths' => [
        'accessLogs',
        'admin/accessLogs',
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom/Extra Authentication via POST/GET
    | default to null , if any then : 'custom_authentication' => 'custom_authentication_name'
    |--------------------------------------------------------------------------
    */
    'custom_authentication' => 'authentication'

    

];
