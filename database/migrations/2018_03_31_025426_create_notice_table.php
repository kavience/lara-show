<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //通知表
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 25)->default('');
            $table->text('content');
            $table->timestamps();
        });

        //用户和通知关系表
        Schema::create('user_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->integer('notice_id')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice');
        Schema::dropIfExists('user_notice');
    }
}
