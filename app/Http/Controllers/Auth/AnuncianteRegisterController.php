<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Events\NovoAnunciante;
use App\Anunciante;
use App\User;
use App\VerifyUser;
use App\Mail\ConfirmarEmail;
use Mail;


class AnuncianteRegisterController extends Controller
{

	

   public function __construct()
   {
   		$this->middleware('guest:anuncios')->except('logout');
   }


   public function create(Request $request, $perfil)
   {

            $validate = $request->validate([
            	'nome' => 'required|string|max:80|min:10',
            	'creci' => 'nullable|string|min:6|max:7',
            	'contato' => 'nullable|string|min:10',
				'cargo' => 'nullable|string|max:50',
				'email' => 'required|string|email|max:50|unique:anunciantes|unique:users',
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

   public function verifyUser($token)
   {
   	 $verifyUser = VerifyUser::where('token', $token)->first();

   	 if(isset($verifyUser)){

   	 	$anunciante = $verifyUser->anunciante;

   	 	 if(!$anunciante->verified) {
   	 	 	$status = "Vocẽ precisa escolher um plano ou uma forma de pagamento válida antes de continuar!";
   	 	 }else{

   	 	 	$token = $token;
   	 	 	$nome = $anunciante->nome;
   	 	 	$email = $anunciante->email;   	 	 	
   	 	 	$pass = $anunciante->password;

   	 	 	return view('auth.passwords.updateAnunciante',compact(['token', 'nome', 'email', 'pass'], [$token, $nome, $email, $pass]));
   	 	 }

   	 }else{
   	 	return redirect('anunciante/login')->with('warning', "Desculpe seu cadastro não pode ser identificado..");
   	 }

   	 return redirect('anunciante/login')->with('status', $status);

   }


   public function update(Request $request)
   {
   		
		if (isset($request['token'])){

				$password = [
					'password' => $request['password'],
					'password_confirmation' => $request['password_confirmation']
				];

			 	$validator = Validator::make($password, [            
                    'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'password_confirmation' => 'required|string|min:6'
                ]);
			
		   		$token = $request['token'];

		   		$verifyUser = VerifyUser::where('token', $token)->first();

		   		$anunciante = $verifyUser->anunciante;

				if ($validator->fails()){
					return back()->withErrors($validator)->withInput();
				}else{

					if (empty($anunciante->password)) {
						
					$anunciante->password = Hash::make($password['password']);
					$anunciante->save();

					$status = "Sua senha foi cadastrada com sucesso! Agora vocẽ está pronto para fazer o seu login.";

					}else{
						$status = "Você já tem uma senha cadastrada no momento!";
					}

					return redirect('/anunciante/login')->with('status', $status);
				}


		}else{
			 return response()->json(['error' => 'Not authorized.'],403);
		}


   }


}
