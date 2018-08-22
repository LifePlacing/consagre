<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImovelType extends Model
{


    protected $table = 'imovel_types';

    protected $fillable = [
    	'tipo'
    ];

    public function imovels(){
    	return $this->hasMany('App\Imovel');
    }


}
