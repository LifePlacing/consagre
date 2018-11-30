<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anunciante extends Authenticatable
{
   
   use Notifiable;

   protected $fillable = [

   	'nome', 'tipo', 'creci', 'email', 'phone_fixo', 'celular', 'password', 'site', 'sobre',
   	'cep', 'cidade', 'logradouro', 'bairro', 'unidade', 'logo', 'contato', 'cargo', 'plano_id'

   ];


	public function plano()
	{
		return $this->belongsTo("App\Plano");
	}

	public function verifyAnunciante()
	{
	    return $this->hasOne('App\VerifyUser');
	}

	public function payments(){
		return $this->hasMany('App\Payment');
	}

   
}
