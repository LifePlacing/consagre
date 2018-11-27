<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{

	protected $fillable = [
		'codigo', 'nome', 'quant_anuncios', 'super_destaques', 'destaques', 'valor_mensal', 'captacao'
	];
    

    public function anunciantes()
    {
    	return $this->hasMany('App\Anunciante');
    }
}
