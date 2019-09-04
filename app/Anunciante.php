<?php

namespace App;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anunciante extends Authenticatable
{  
  use Notifiable; 


  protected $guard = 'anuncios';

  protected $fillable = [
   	'nome', 'tipo', 'creci', 'email', 'phone_fixo', 'celular', 'site', 'sobre',
   	'cep', 'cidade', 'logradouro', 'bairro', 'unidade', 'logo', 'contato', 'cargo', 'plano_id', 'cpf'
  ];

  protected $hidden = [
    'password', 'remember_token'
  ];


  public function imovels(){
      return $this->hasMany('App\Imovel');
  }

	public function plano()
	{
		return $this->belongsTo("App\Plano");
	}

	public function verifyAnunciante()
	{
	    return $this->hasOne('App\VerifyUser');
	}

  public function assinaturas()
  {
    return $this->hasMany('App\Assinatura');
  }

	public function payments(){
		return $this->hasMany('App\Payment');
	}

  public function mensagens()
  {
    return $this->hasMany('App\Mensagem');
  }

   
}
