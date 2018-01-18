<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pid')->default(0)->comment('父id');
            $table->tinyInteger('type')->default(0)->comment('菜单类型:0:view 1:click');
            $table->string('title')->default('')->comment('菜单名');
            $table->string('url')->default('')->comment('地址');
            $table->string('key')->default('')->comment('键值');
            $table->tinyInteger('has_sub')->default(0)->dcomment('是否含子菜单:0:否 1:是');
            $table->tinyInteger('sort')->default(1)->dcomment('排序号');
            $table->dateTime('created_at')->nullable()->comment('创建时间');
            $table->dateTime('updated_at')->nullable()->comment('修改时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_menus');
    }
}
