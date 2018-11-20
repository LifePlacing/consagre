<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
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
        
        $imovelCidade = Cidade::where('slug','=', $cidade)->first();

        if (!empty($imovelCidade->id)) {

            $busca = Imovel::hasStatus()->where('cidade_id', '=', $imovelCidade->id)->orderBy('created_at', 'desc');

            $total_resultados = $busca->count();

            if ($total_resultados > 0) { 

                $imoveis = $busca->paginate(10);

                return view('app.imoveis.search_cidades', compact(['imoveis', 'total_resultados'], [$imoveis, $total_resultados]));          
            }else{
                return view('app.imoveis.search_cidades')
                ->withErrors(['Nenhum registro de Imovel Encontrado']);
             }

            
        }else{
                return view('app.imoveis.search_cidades')
                ->withErrors(['Nenhum registro de Imovel Encontrado']);
        }

                     
    }


/*============ busca imoveis form pesquisa ==========*/

    public function getImoveis(Request $request)
    {
    
       $pesquisa = $request->except('_token');

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
                            ->withErrors(['Nenhum registro de Imovel Encontrado']);
        }else{

            $search = $busca->paginate(10); 
          return view('app.imoveis.search_imoveis', compact(['search', 'pesquisa', 'total_resultados'], 
            [$search, $pesquisa, $total_resultados]));
       }

    }


    public function searchImoveis(Request $request){      

        return view('app.imoveis.search_imoveis');
    }



    public function singleImovel($titulo, $id, $meta, $cidade){        

        $propriedade = Imovel::with('user')->find($id);

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
