<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    
    protected $fillable = [
		'nome', 'email', 'cliente_id', 'cliente_secret', 'cliente_sandbox', 'token'
	];
	
}
