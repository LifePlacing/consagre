<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{

  use SoftDeletes;

	protected $fillable = [
	    'titulo','meta', 'preco', 'cep','suites', 
	    'banheiros', 'quartos', 'area_total', 'cidade_id', 'logradouro', 'bairro', 'user_id', 'imovel_type_id', 'categoria_id', 'unidade', 'estado', 'garagem', 'area_util', 'descricao', 'codigo', 'iptu', 'condominio'
	];

  protected $hidden = [
      
  ];

  protected $dates = ['deleted_at'];    
  

 public function media(){
 		return $this->hasMany('App\Media');
 }

 public function user(){
 		return $this->belongsTo('App\User');
 }

 public function cidade(){
  return $this->belongsTo('App\Cidade');
 }

 public function imovel_type(){
       return $this->belongsTo('App\ImovelType');
 }

 public function categoria(){
       return $this->belongsTo('App\Categoria');
 }   

 /*escopos da busca de Imoveis ativos */

  public function scopeHasStatus($query)
  {
      return $query->where('status', '=', '0');
  }

  public function scopePrecoMinMax($query, $opt, $valorMin, $valorMax)
  {
      if($valorMin > 0 || $valorMax < 50000){          
          if ($valorMin > 0 && $valorMax < 50000 ) {
              return $query->whereBetween($opt, [$valorMin, $valorMax ]);
          }else if($valorMin > 0 && $valorMax == 50000){
              return $query->where($opt, '>=', $valorMin);
          }
      }
  }

  public function scopeAreaMinMax($query, $opt, $valorMin, $valorMax)
  {
    if ($valorMin > 0 || $valorMax < 10000) {

          if ($valorMin > 0 && $valorMax < 10000 ) {
              return $query->whereBetween($opt, [$valorMin, $valorMax ]);
          }else if($valorMin > 0 && $valorMax == 10000){
              return $query->where($opt, '>=', $valorMin);
          }        
      
    }
  }

  public function scopeQuantItens($query, $valor, $qOpt1, $qOpt2, $qOpt3, $qOpt4)
  {

      if (!empty($qOpt1) && !empty($qOpt2) && !empty($qOpt3)){ 

        return $query->whereIn($valor, [1,2,3]);

      }else if (!empty($qOpt1) && !empty($qOpt2)) {

        return $query->whereIn($valor, [1, 2]);

      }else if (!empty($qOpt1) && !empty($qOpt3)) {

        return $query->whereIn($valor, [1, 3]);

      }else if (!empty($qOpt2) && !empty($qOpt3)) { 

        return $query->whereIn($valor, [2, 3]);

      }else if (!empty($qOpt1) || !empty($qOpt2) || !empty($qOpt3)) { 

          if (!empty($qOpt1)) {
            return $query->where($valor, '=', 1);
          }

          if (!empty($qOpt2)) {
             return $query->where($valor, '=', 2);
          }

          if (!empty($qOpt3)) {
            return $query->where($valor, '=', 3);
          }
        
      }else if(!empty($qOpt4)){
          return $query->where($valor, '>=', 4);
      }


  }


}
