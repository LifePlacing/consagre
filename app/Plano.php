<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{

    /*Para interval = 0 (Plano Pré-pago) | interval = 1 (Assinatura Mensal) */

	protected $fillable = [
		 'codigo','nome', 'quant_anuncios', 'super_destaques', 'destaques', 'valor_mensal', 'captacao', 'interval'
	];
    
     protected $hidden = [
        'codigo'
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
