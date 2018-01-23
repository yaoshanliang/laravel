<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatReplysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_replys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type')->default(0)->comment('0:文本回复,1:单图文');
            $table->string('keyword')->comment('关键字');
            $table->text('content')->default('')->comment('回复内容');
            $table->string('title')->default('')->comment('图文标题');
            $table->string('image')->default('')->comment('图文封面');
            $table->string('link')->default('')->comment('链接地址');
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
        Schema::dropIfExists('wechat_replys');
    }
}
