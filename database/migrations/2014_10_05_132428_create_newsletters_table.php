<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_langues')->unsigned();
            $table->string('titre', 100);
            $table->text('contenu');
            $table->datetime('date_envoi');
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
        Schema::drop('newsletters');
    }
}
