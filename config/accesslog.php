<?php

return [

    
    /*
    |--------------------------------------------------------------------------
    | Authentication Guards Models for taggable morphs
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

    'guards' => [
        'web' => 'App\User',

        'api' => 'App\User',
        
        'admin-api' => 'App\Admin',
    ],

    

];
