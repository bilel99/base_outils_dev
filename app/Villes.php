<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    /**
     * @var string
     */
    protected $table = 'villes';
    protected $fillable = ['id_pays', 'libelle'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pays(){
        return $this->belongsTo('\App\Pays', 'id_pays');
    }


    /**
     * @return bool|string
     */
    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

}