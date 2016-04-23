<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationHistory', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_users')->unsigned();
            $table->integer('id_notif')->unsigned()->nullable();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->enum('status', array('1', '0'));
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notificationHistory');
    }
}
