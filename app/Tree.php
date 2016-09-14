<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    protected $table = 'tree';
    protected $fillable = ['id_langues', 'nom', 'slug', 'libelle', 'ordre', 'status'];


    public function langues(){
        return $this->belongsTo('\App\Langues', 'id_langues');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
