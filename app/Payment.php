<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    	'charge_id', 'status', 'payment', 'plan_id', 'notification_token', 'anunciante_id', 'assinatura_id'
    ];

    public function anunciante()
    {
    	return $this->belongsTo('App\Anunciante');
    }

    public function assinatura()
    {
    	return $this->belongsTo('App\Assinatura');
    }


}
