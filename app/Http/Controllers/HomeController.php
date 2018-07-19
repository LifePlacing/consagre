<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
    	if (!Gate::allows('isProprietario')) {
    		
    		abort(404, "Não permitido");
    	}
        return view('home');
    }
}
