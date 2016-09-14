<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_langues')->unsigned()->nullable();
            $table->string('nom', 255);
            $table->string('slug', 255);
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
        Schema::drop('tree');
    }
}
