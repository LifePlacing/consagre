<?php

namespace App;

use App\VerifyUser;
use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'nome', 'email', 'password'
    ];


    protected $hidden = [
        'password', 'remember_token'
    ];
    

}
