<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('account')->comment('账号');
            $table->string('realname')->nullable()->comment('真实姓名');
            $table->string('email')->nullable()->index()->comment('邮箱');
            $table->string('phone')->nullable()->index()->comment('手机号');
            $table->string('openid')->nullable()->comment('微信openid');
            $table->string('nickname')->nullable()->comment('昵称');
            $table->string('headimgurl')->nullable()->comment('头像');
            $table->string('password')->comment('密码');
            $table->rememberToken()->comment('记住密码');
            $table->integer('status')->default(0)->comment('用户状态(0:正常,1:禁用)');
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
        Schema::drop('users');
    }
}
