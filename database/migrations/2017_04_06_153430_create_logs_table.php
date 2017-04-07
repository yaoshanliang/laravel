<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('guard')->nullable()->comment('来源');
            $table->integer('user_id')->nullable()->comment('用户ID');

            $table->string('request_method')->nullable()->comment('请求方式');
            $table->string('request_url')->nullable()->comment('请求地址');
            $table->text('request_params')->nullable()->comment('请求参数');

            $table->integer('response_code')->nullable()->comment('返回码');
            $table->string('response_message')->nullable()->comment('返回消息');
            $table->text('response_data')->nullable()->comment('返回数据');

            $table->string('user_ip')->nullable()->comment('用户IP');
            $table->string('user_agent')->nullable()->comment('用户agent');
            $table->string('server_ip')->nullable()->comment('服务器IP');

            $table->float('request_time_float', 14, 4)->comment('请求时间');
            $table->float('pushed_time_float', 14, 4)->comment('响应时间');
            $table->float('poped_time_float', 14, 4)->comment('处理时间');
            $table->float('created_time_float', 14, 4)->comment('写库时间');
            $table->timestamp('created_at')->nullable()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
