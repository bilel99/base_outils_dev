<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    protected $table = 'pays';
    protected $fillable = ['code', 'alpha2', 'alpha3', 'nom_fr_fr', 'nom_en_gb'];

}