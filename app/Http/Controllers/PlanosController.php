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

            $expired = false;
    	
    		if (isset($anunciante->plano_id)) {
    			$expired = true;
    		}

            if($anunciante->password !== null || !empty($anunciante->password)){
                return redirect()->route('anunciante.login')->with('status', ' Acesse seu painel para anunciar seus imoveis.');
            }

            if($anunciante->verified == 1 && empty($anunciante->password)){
                return redirect()->route('anunciante.login')->with('status', 'Tudo certo! Você deve receber um email para cadastrar sua senha em breve. Obrigado');
            }

        	return view('payment.plano')->with('anunciante', $anunciante)->with('planos', $planos)->with('expired', $expired);
    	}

	}




}
