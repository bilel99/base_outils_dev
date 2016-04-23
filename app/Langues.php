<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Langues extends Model
{
    protected $table = 'langues';
    protected $fillable = ['code', 'libelle'];

}
