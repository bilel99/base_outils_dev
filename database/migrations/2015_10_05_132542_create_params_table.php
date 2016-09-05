<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('params', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_langues')->unsigned()->nullable();
            $table->string('code', 255);
            $table->string('libelle', 255);
            $table->enum('status', array('1', '0'));
            $table->timestamps();

            $table->foreign('id_langues')->references('id')->on('langues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('params');
    }
}
