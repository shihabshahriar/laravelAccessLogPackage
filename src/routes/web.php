<?php


Route::get('hell-from-access-log', function(){
    return 'Hello from the access log package';
});


Route::get('annanovas-access-logs-user-search', '\AnnaNovas\AccessLog\Http\controllers\AccessLogController@searchUsers')->name('accesslog.access-logs-user-search');

?>