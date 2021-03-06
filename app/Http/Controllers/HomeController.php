<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Imovel;
use App\ImovelType;
use App\Cidade;

class HomeController extends Controller
{

    public function anuncio()
    {
        return view('app.anunciante');
    }

    public function app()
    {
        $imoveislist = Imovel::hasStatus()
        ->where('tipo_de_anuncio', '=', 'super')    
        ->latest()->get();

        $imoveisAluguel = $imoveislist->where('meta', '=', 'aluguel')->take(4);
        $imoveisVenda = $imoveislist->where('meta', '=', 'venda')->take(4);
        
        $tipos = ImovelType::pluck('id', 'tipo');

        $cidades = Cidade::pluck('id', 'nome'); 

        return view('app.index', compact(['imoveislist', 'tipos', 'cidades', 'imoveisAluguel', 'imoveisVenda'], [$imoveislist, $tipos, $cidades, $imoveisAluguel, $imoveisVenda ]));
    }


    public function registroUser()
    {
        return view('app.cadastros.usuarios');
    }


}
