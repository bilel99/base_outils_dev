<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Users extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'users';
    protected $fillable = ['id_villes', 'id_roles_users', 'nom', 'prenom', 'email', 'password', 'adresse', 'telephone', 'date_naissance', 'statut', 'avatar', 'derniere_connexion'];


    public function role(){
        return $this->belongsTo('\App\Roles_users', 'id_roles_users');
    }

    public function ville(){
    	return $this->belongsTo('\App\Villes', 'id_villes');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
