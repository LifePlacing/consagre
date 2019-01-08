<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Xml extends Model
{

	protected $fillable = [
		'sistema', 'url', 'LastPublishDate', 'anunciante_id'
	];
	

    public function anunciante()
    {
    	return $this->belongsTo("App\Anunciante");
    }
}
