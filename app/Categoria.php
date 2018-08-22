<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $table = 'categorias';

    protected $fillable = [
    	'name'
    ];
    
    public function imovels(){
    	return $this->hasMany('App\Imovel');
    }
}
