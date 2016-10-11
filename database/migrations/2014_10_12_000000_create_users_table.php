<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('id_villes')->unsigned()->nullable();
            $table->integer('id_roles_users')->unsigned();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('email', 100)->unique();
            $table->string('password', 60);
            $table->string('adresse', 200)->nullable();
            $table->integer('telephone')->nullable();
            $table->date('date_naissance')->nullable();
            $table->enum('statut', array('Actif', 'Archivé'));
            $table->string('avatar', 255);
            $table->string('forgotPass', 60)->nullable();
            $table->datetime('derniere_connexion')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_villes')->references('id')->on('villes');
            $table->foreign('id_roles_users')->references('id')->on('roles_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
