<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_pays')->unsigned();
            $table->string('libelle', 50)->unique();
            $table->timestamps();

            $table->foreign('id_pays')->references('id')->on('pays');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('villes');
    }
}
