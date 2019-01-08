<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Events\NovoAnunciante;

class AnuncianteLoginController extends Controller
{
   public function __construct()
   {
   		$this->middleware('guest:anuncios')->except('logout');
   }


   public function login(Request $request)
   {

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required',
        ],
        [
            'email.required' => 'Usuario ou Email é requerido',
            'password.required' => 'Precisa informar sua senha',
        ]);

        $credentials = [
        	'email' => $request->email,
        	'password' => $request->password
        ];


        $auth = Auth::guard('anuncios')->attempt($credentials, $request->remember);

        if ($auth) {
	       	return redirect()->intended(route('anunciante.dashboard'));	
        }

        return $this->sendFailedLoginResponse($request); 


   }


   protected function authenticated(Request $request, $user)
	{
	       if (!$user->verified) {

            auth()->logout();
            
            return $this->reenvia($user);

        }
        
        return redirect()->intended($this->redirectPath());
	}

  protected function sendFailedLoginResponse(Request $request)
  {
      throw ValidationException::withMessages([
          'email' => [trans('auth.failed')],
      ]);
  }
  

  public function reenvia($user)
  {

    event(new NovoAnunciante($user));

    return back()->with('warning', 'Nós lhe enviamos um email com alguns dados para ativação da sua conta. Verifique seu e-mail e clique no link para continuar. Esta ação é necessária!');      
     
  } 


   public function index()
   {
   		return view('auth.anunciantes-login');
   }
}
