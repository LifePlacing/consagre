<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

	protected $fillable = [
	    'source', 'imovel_id', 'position',
	];

   public function imovel(){
   	return $this->belongsTo('App\Imovel');   	
   }
   
}
