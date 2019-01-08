<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    
    protected $fillable = [
		'custom_id', 'plano_id', 'name', 'value', 'status', 'anunciante_id', 'last_charge'
	];

	public function plano()
	{
		return $this->belongsTo('App\Plano');
	}

	public function payments()
	{
		return $this->hasMany('App\Payment');
	}

	public function anunciante()
	{
		return $this->belongsTo('App\Anunciante');
	}

    
}
