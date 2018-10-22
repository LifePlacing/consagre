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
   	'cep', 'cidade', 'logradouro', 'bairro', 'unidade', 'logo', 'contato', 'cargo',

   ];

   public function imoveis(){
   		return $this->belongsToMany("App\Imovel", "alocacoes");
   }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

   
}
