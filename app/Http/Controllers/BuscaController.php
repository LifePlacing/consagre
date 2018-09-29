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

   

/*============ busca por cidades ==========*/

    public function getCidade($cidade)
    {
        
        $imovelCidade = Cidade::where('slug','=', $cidade)->first();

        if (!empty($imovelCidade->id)) {

            $imoveis = Imovel::hasStatus()->where('cidade_id', '=', $imovelCidade->id)->paginate(10);

            if (count($imoveis) > 0) { 
                return view('app.imoveis.search_cidades', compact(['imoveis'], [$imoveis]));          
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

        $imoveis = Imovel::hasStatus()
        			->QuantItens('quartos', $request['qOpt1'], $request['qOpt2'], $request['qOpt3'], $request['qOpt4'])
        			->QuantItens('suites', $request['sOpt1'], $request['sOpt2'], $request['sOpt3'], 
        				$request['sOpt4'])
        			->QuantItens('garagem', $request['vOpt1'], $request['vOpt2'], $request['vOpt3'], $request['vOpt4'] )
        			->PrecoMinMax('preco', $request['minpreco'], $request['maxpreco'])
        			->AreaMinMax('area_total', $request['areaInicial'], $request['areaFinal'])
        			->where('meta', '=', $request['meta'])->get();

		/*Coletando os dados */

        $tipo = $request['imovel_type_id'];
        $cidade = $request['cidade'];

        /*========== Filtros simples do formulário ============= */

          	if ($tipo != 'all' || $cidade != 'all') {
                
               if ($tipo != 'all') {                
                    $id_tipo = (int)$tipo;
                    $search = $imoveis->where('imovel_type_id', '=', $id_tipo);
                }

                if ($cidade != 'all') {
                   $id_cidade = (int)$cidade;
                   $search = $imoveis->where('cidade_id', '=', $id_cidade);
                }

         	}else{
         		 $search = $imoveis;
         	}

        

        if ($search->count() == 0) { 

            return redirect()->route('searchImoveis')
                            ->withErrors(['Nenhum registro de Imovel Encontrado']);

        }else{

            $request->session()->flash('search', $search);

           return redirect()->route('searchImoveis');           
       }

    }


    public function searchImoveis(Request $request){

        $search = $request->session()->get('search');

        $lista = Imovel::hasStatus()->paginate(10);

        return view('app.imoveis.search_imoveis', compact(['search', 'lista'], [$search, $lista]));
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
