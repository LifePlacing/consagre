<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
    	'charge_id', 'status', 'payment', 'plan_id', 'notification_token', 'anunciante_id'
    ];

    public function anunciante()
    {
    	return $this->belongsTo('App\Anunciante');
    }

}
