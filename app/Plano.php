<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    public function anunciantes()
    {
    	return $this->hasMany('App\Anunciante');
    }
}
