<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gate;
use App\Imovel;
use App\ImovelType;
use App\Categoria;

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
        return view('home');
    }

    public function app()
    {
        $imoveislist = Imovel::where('status', '=', '0')->latest()->get();
        
        /* Região pelo CEP */
        $regSantos = Imovel::whereBetween('cep', [11000000, 11729999])->latest()->get();

        $tipos = ImovelType::pluck('id', 'tipo');;

        $categorias = Categoria::pluck('id', 'name'); 

        return view('app.index', compact(['imoveislist', 'tipos', 'categorias', 'regSantos'], [$imoveislist, $tipos, $categorias, $regSantos]));
    }


}
