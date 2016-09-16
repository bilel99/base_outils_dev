<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actu', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_langues')->unsigned()->nullable();
            $table->integer('id_users')->unsigned()->nullable();
            $table->string('libelle', 255);
            $table->string('description', 255);
            $table->string('image', 255);
            $table->enum('status', array('1', '0'));
            $table->timestamps();

            $table->foreign('id_langues')->references('id')->on('langues');
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
        Schema::drop('actu');
    }
}
