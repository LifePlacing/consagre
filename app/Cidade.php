<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
   protected $fillable = ['slug', 'nome'];

   public function imovels(){
   		return $this->hasMany('App\Imovel');
   }

}
