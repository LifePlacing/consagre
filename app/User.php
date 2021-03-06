<?php

namespace App;

use App\VerifyUser;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',  'cpf', 'phone', 'sobre', 'sexo', 'foto', 'sobrenome'
    ];


    protected $hidden = [
        'password', 'remember_token', 'user_type'
    ];
    


    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function imovels(){
        return $this->hasMany('App\Imovel');
    }




}
