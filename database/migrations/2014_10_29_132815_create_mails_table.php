<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_langues')->unsigned()->nullable();
            $table->string('type', 255);
            $table->string('nom', 255);
            $table->string('exp_nom', 255);
            $table->string('exp_email', 255);
            $table->string('sujet', 255);
            $table->text('contenue');
            $table->enum('statut', array('Actif', 'inactif'));
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
        Schema::drop('mails');
    }
}
