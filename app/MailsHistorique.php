<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailsHistorique extends Model
{

    protected $table = 'mails_Historique';
    protected $fillable = ['id_langues', 'type', 'nom', 'exp_nom', 'exp_email', 'sujet', 'contenue'];


    public function langues(){
        return $this->belongsTo('\App\Langues', 'id_langues');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
