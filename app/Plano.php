<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{

	protected $fillable = [
		'codigo', 'name', 'quant_anuncios', 'super_destaques', 'destaques', 'valor_mensal', 'captacao', 'interval'
	];
    

    public function anunciantes()
    {
    	return $this->hasMany('App\Anunciante');
    }

    public function assinaturas()
    {
    	return $this->hasMany('App\Assinatura');
    }



}
