<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anunciante;

class AnunciantesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:anuncios')->except('cadastro');
    }


    public function index()
    {
    	return view('users.anunciantes.index');
    }


    public function cadastro($perfil)
    {
    	if ($perfil == 'imobiliaria') {
    		return view('app.cadastros.imobiliaria');
    	}else if($perfil == 'corretor'){
    		return view('app.cadastros.corretor');
    	}else{
    		abort(403, 'Esta página não existe');
    	}
    }


    public function store(Request $request, $perfil){


    	
    }

}
