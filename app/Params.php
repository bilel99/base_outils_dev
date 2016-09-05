<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Params extends Model
{
    /**
     * @var string
     */
    protected $table = 'params';
    protected $fillable = ['id_langues', 'code', 'libelle', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function langue(){
        return $this->belongsTo('\App\Langues', 'id_langues');
    }


    /**
     * @return bool|string
     */
    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }

}