<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id')->comment('自增ID');
            $table->string('account')->comment('账号');
            $table->string('name')->nullable()->comment('真实姓名');
            $table->string('email')->nullable()->index()->comment('邮箱');
            $table->string('phone')->nullable()->index()->comment('手机号');
            $table->integer('role_id')->nullable()->comment('角色ID');
            $table->string('role_name')->nullable()->comment('角色');
            $table->string('password')->comment('密码');
            $table->rememberToken()->comment('记住密码');
            $table->integer('status')->default(0)->comment('管理员状态(0:正常,1:不可登录)');
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
        Schema::dropIfExists('admins');
    }
}
