<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('code')->unsigned();
            $table->string('alpha2', 50)->unique();
            $table->string('alpha3', 50)->unique();
            $table->string('nom_fr_fr', 50)->unique();
            $table->string('nom_en_gb', 50)->unique();
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
        Schema::drop('pays');
    }
}
