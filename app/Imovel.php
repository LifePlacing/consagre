<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{



	protected $fillable = [
	    'titulo','meta', 'preco', 'cep','suites', 
	    'banheiros', 'quartos', 'area_total', 'cidade', 'logradouro', 'bairro', 'user_id', 'imovel_type_id', 'categoria_id', 'unidade', 'estado', 'garagem', 'area_util', 'descricao',
	];

    protected $hidden = [
        
    ];   

   public function media(){
   		return $this->hasMany('App\Media');
   }

   public function user(){
   		return $this->belongsTo('App\User');
   }

   public function imovel_type(){
         return $this->belongsTo('App\ImovelType');
   }

   public function categoria(){
         return $this->belongsTo('App\Categoria');
   }   


}
