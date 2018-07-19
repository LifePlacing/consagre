<?php

namespace App;

use App\VerifyUser;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    protected $fillable = [
        'name', 'email', 'password', 'user_type',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
