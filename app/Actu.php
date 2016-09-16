<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actu extends Model
{
    protected $table = 'actu';
    protected $fillable = ['id_langues','id_users', 'libelle', 'description', 'status', 'image'];


    public function langues(){
    	return $this->belongsTo('\App\Langues', 'id_langues');
    }

    public function users(){
        return $this->belongsTo('\App\Users', 'id_users');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
