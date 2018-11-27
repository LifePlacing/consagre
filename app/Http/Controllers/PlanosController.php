<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VerifyUser;

use App\Plano;

class PlanosController extends Controller
{
    
    public function planos($token){

        //$anunciante = Anunciante::find($id);

        $verifyAnunciante = VerifyUser::where('token', $token)->first();

        $planos = Plano::all();

        if(isset($verifyAnunciante) ){

            $anunciante = $verifyAnunciante->anunciante;
      
        	return view('payment.plano')->with('anunciante', $anunciante)->with('planos', $planos);
    	}

	}




}
