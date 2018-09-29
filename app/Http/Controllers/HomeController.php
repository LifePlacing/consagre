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

    public function __construct()
    {
        $this->middleware('auth')->except('app');
    }


    public function index()
    {
    	/*if (!Gate::allows('isProprietario')) {
    		
    		abort(404, "Não permitido");
    	}*/
        return view('users.index');
    }

    public function app()
    {
        $imoveislist = Imovel::hasStatus()->latest()->get();

        $imoveisAluguel = $imoveislist->where('meta', '=', 'aluguel')->take(4);
        $imoveisVenda = $imoveislist->where('meta', '=', 'venda')->take(4);
        
        $tipos = ImovelType::pluck('id', 'tipo');

        $cidades = Cidade::pluck('id', 'nome'); 

        return view('app.index', compact(['imoveislist', 'tipos', 'cidades', 'imoveisAluguel', 'imoveisVenda'], [$imoveislist, $tipos, $cidades, $imoveisAluguel, $imoveisVenda ]));
    }


}
