<?php

namespace App;

use App\User;
use App\Anunciante;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
 	protected $guarded = [];
 
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }  


    public function anunciante()
    {
    	return $this->belongsTo('App\Anunciante', 'anunciante_id');
    }  
}
