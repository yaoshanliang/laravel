<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('自增ID');
            $table->string('queue')->comment('队列名');
            $table->longText('payload')->comment('数据');
            $table->tinyInteger('attempts')->unsigned()->comment('尝试次数');
            $table->unsignedInteger('reserved_at')->nullable()->comment('保留时间');
            $table->unsignedInteger('available_at')->comment('可用时间');
            $table->unsignedInteger('created_at')->comment('创建时间');
            $table->index(['queue', 'reserved_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
