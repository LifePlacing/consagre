<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
   protected $table = 'mensagems';

  protected $fillable = [
   		'msg', 'imovel_id', 'email_remetente', 'nome_remetente', 'telefone', 'anunciante_id'
  ];

  protected $dates = ['read_at', 'created_at'];

  public function imovel()
  {
  	return $this->belongsTo('App\Imovel');
  }

  public function anunciante()
  {
  	return $this->belongsTo('App\Anunciante');
  }

}
