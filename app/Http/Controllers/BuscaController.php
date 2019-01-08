<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Imovel;
use App\ImovelType;
use App\Categoria;
use App\Cidade;


class BuscaController extends Controller
{


/*Busca por venda ou aluguel*/

    public function getMeta($meta){

        $busca = Imovel::hasStatus()->where('meta', '=', $meta)->orderBy('created_at', 'desc');

        $total_resultados = $busca->count();

        if ($total_resultados > 0) { 

            $imoveis = $busca->paginate(10);

            return view('app.imoveis.search_cidades', compact(['imoveis', 'total_resultados'], [$imoveis, $total_resultados]));          
        }else{
            return view('app.imoveis.search_cidades')
            ->withErrors(['Nenhum registro de Imovel Encontrado']);
         }

    }
   

/*============ busca por cidades ==========*/

    public function getCidade($cidade)
    {

        if(!Cache::has($cidade))
        {
            Cache::put($cidade,  Cidade::where('slug','=', $cidade)->first(), 20);
        }        

        $imovelCidade = Cache::get($cidade);


        if (!empty($imovelCidade->id)) {

            $busca = Imovel::hasStatus()
                    ->where('cidade_id', '=', $imovelCidade->id)                    
                    ->orderBy('created_at', 'desc');

            $total_resultados = $busca->count();


            if(!Cache::has('super')){

                Cache::put('super',  Imovel::hasStatus()
                            ->where('cidade_id', '=', $imovelCidade->id)
                            ->where('tipo_de_anuncio', '=', 'super')->inRandomOrder()->take(4)->get(), 10); 
            }

            if(!Cache::has('destaque')){                
                
                Cache::put('destaque',  Imovel::hasStatus()
                            ->where('cidade_id', '=', $imovelCidade->id)
                            ->where('tipo_de_anuncio', '=', 'destaque')->inRandomOrder()->take(5)->get(), 5); 
            }            

            $super =  Cache::get('super');

            $destaque = Cache::get('destaque');


            if ($total_resultados > 0) { 

                $imoveis = $busca->paginate(10);                

                return view('app.imoveis.search_cidades', compact(['imoveis', 'total_resultados', 'super', 'destaque'], [$imoveis, $total_resultados, $super, $destaque]));          
            
            }

            
        }else{

                $falseCidade = Imovel::where('tipo_de_anuncio', '=', 'super')->get(); 

                return view('app.imoveis.search_cidades', compact(['falseCidade'], [$falseCidade]))
                ->withErrors(['Nenhum registro de Imovel Encontrado']);
        }

                     
    }


/*============ busca imoveis form pesquisa ==========*/

    public function getImoveis(Request $request)
    {
    
        $pesquisa = $request->except('_token');

        if($request['cidade'] !== 'all'){

           if(!Cache::has( 'search_cidade'.$request['cidade'] )){

                Cache::put('search_cidade'.$request['cidade'], Imovel::hasStatus()
                    ->CidadeId($request['cidade'])
                    ->Meta($request['meta'])
                    ->where('tipo_de_anuncio', '=', 'super')
                    ->inRandomOrder()->take(4)->get(), 10 );
           }

           $super = Cache::get('search_cidade'.$request['cidade']);

        }else{
                if(!Cache::has('search_cidade_all')){

                    Cache::put('search_cidade_all', Imovel::hasStatus()
                        ->Meta($request['meta'])
                        ->where('tipo_de_anuncio', '=', 'super')
                        ->inRandomOrder()->take(4)->get(), 10 );
               }

               $super = Cache::get('search_cidade_all');
        }
        

        $busca = Imovel::hasStatus()
                    ->TipoImovelId($request['imovel_type_id'])
                    ->CidadeId($request['cidade'])
        			->QuantItens('quartos', $request['qOpt1'], $request['qOpt2'], $request['qOpt3'], $request['qOpt4'])
        			->QuantItens('suites', $request['sOpt1'], $request['sOpt2'], $request['sOpt3'], 
        				$request['sOpt4'])
        			->QuantItens('garagem', $request['vOpt1'], $request['vOpt2'], $request['vOpt3'], $request['vOpt4'] )
        			->PrecoMinMax('preco', $request['minpreco'], $request['maxpreco'])
        			->AreaMinMax('area_total', $request['areaInicial'], $request['areaFinal'])
        			->Meta($request['meta'])                    
                    ->orderBy('created_at', 'desc');
        
        $total_resultados = $busca->count();

        if ($total_resultados == 0) { 

            return redirect()->route('searchImoveis')
                            ->withErrors(['Nenhum registro de Imovel Encontrado'])
                            ->with('super', $super);
        }else{

            //$destaque = $busca->get();

            $search = $busca->paginate(10); 

            return view('app.imoveis.search_imoveis', compact(['search', 'pesquisa', 'total_resultados', 'super'], 
            [$search, $pesquisa, $total_resultados, $super]));
        }

    }


    public function searchImoveis(Request $request){      

        return view('app.imoveis.search_imoveis');
    }



    public function singleImovel($titulo, $id, $meta, $cidade){        

        $propriedade = Imovel::with('user')->find($id);


        if(Cache::has($id)==false)
        {
          Cache::add($id,'contador',0.30);          

          $propriedade->total_visualizacao+=1;
          $propriedade->save();
        }

        $c = Cidade::where('slug', '=', $cidade)->first();

        $usuario = $propriedade->user;

        if ($c != null && !empty($c) && $c->imovels->count() > 1 ) {
            $relacionados = Imovel::hasStatus()
            ->where('cidade_id', '=', $c->id)
            ->where('id', '!=', $id)
            ->where('meta', '=', $meta)->take(8)->get(); 

        }else{
            $relacionados = Imovel::hasStatus()
            ->where('meta', '=', $meta)
            ->where('id', '!=', $id)
            ->orderBy('created_at')
            ->take(8)->get();

        }


        return view('app.imoveis.single', compact(['propriedade', 'relacionados', 'usuario'], [$propriedade, $relacionados, $usuario]));

    }

    
}
