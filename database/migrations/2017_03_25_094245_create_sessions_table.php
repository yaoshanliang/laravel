<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique()->comment('session id');
            $table->integer('user_id')->nullable()->comment('用户ID');
            $table->string('ip_address', 45)->nullable()->comment('ip地址');
            $table->text('user_agent')->nullable()->comment('user agent');
            $table->text('payload')->comment('数据');
            $table->integer('last_activity')->comment('最后活跃时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
