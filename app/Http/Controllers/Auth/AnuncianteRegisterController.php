<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Events\NovoAnunciante;
use App\Anunciante;
use App\VerifyUser;
use App\Mail\ConfirmarEmail;
use Mail;

class AnuncianteRegisterController extends Controller
{

	

   public function __construct()
   {
   		$this->middleware('guest:anuncios');
   }


   public function create(Request $request, $perfil)
   {

            $validate = $request->validate([
            	'nome' => 'required|string|max:80|min:10',
            	'creci' => 'nullable|string|min:6|max:7',
            	'contato' => 'nullable|string|min:10',
				'cargo' => 'nullable|string|max:50',
				'email' => 'required|string|email|max:50|unique:anunciantes',
				'phone_fixo' => 'required|string|max:15',
				'celular' => 'nullable|string|max:15',
				'site' => 'nullable|string|max:150',
				'cep' => 'required|string|max:8',
				'logradouro' => 'required|string|max:50',
				'unidade' => 'required|string|max:8',
				'cidade' => 'required|string|max:50',
				'bairro' => 'required|string|max:50',
				'sobre' => 'nullable|string|min:30'
	    	]);

    		
	    		$anunciante = new Anunciante();

	    		$anunciante->fill($validate);
	    		$anunciante->tipo = $perfil;
	    		$anunciante->save();


		    	$verifyUser = VerifyUser::create([
	            'anunciante_id' => $anunciante->id,
	            'token' => str_random(40)
	        	]);

	        	event(new NovoAnunciante($anunciante));	        	 

				return back()->with('status', 'Nós lhe enviamos um email com alguns dados para ativação da sua conta. Verifique seu e-mail e clique no link para continuar.');
        
   }


}
