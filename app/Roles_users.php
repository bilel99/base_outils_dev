<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Roles_users extends Model
{
    protected $table = 'roles_users';
    protected $fillable = ['libelle', 'description'];

}
