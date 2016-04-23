<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class NotificationHistory extends Model
{
    protected $table = 'notificationHistory';
    protected $fillable = ['id_users', 'id_notif', 'title', 'description'];


    public function users(){
        return $this->belongsTo('\App\Users', 'id_users');
    }

    public function getCreateddateAttribute(){
        return date('d/m/Y H\Hi', date_timestamp_get(date_create($this->created_at)));
    }
}
