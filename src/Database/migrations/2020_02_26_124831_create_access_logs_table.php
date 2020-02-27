<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('accesslog_guard_id');
            $table->bigInteger('accesslog_path_id');
            $table->bigInteger('accesslog_protocol_id');
            $table->text('url');
            $table->text('fullUrl');
            $table->integer('accesslog_method_id');
            $table->bigInteger('accesslog_authentication_id')->default(0);
            $table->bigInteger('accesslog_ip_id');
            $table->bigInteger('accesslog_useragent_id');
            $table->nullableMorphs('taggable');
            $table->longText('request_header')->nullable();
            $table->longText('request_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_logs');
    }
}
