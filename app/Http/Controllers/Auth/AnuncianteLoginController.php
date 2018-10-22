<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AnuncianteLoginController extends Controller
{
   public function __construct()
   {
   		$this->middleware('guest:anuncios');
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
	    
	}

  protected function sendFailedLoginResponse(Request $request)
  {
      throw ValidationException::withMessages([
          'email' => [trans('auth.failed')],
      ]);
  }




   public function index()
   {
   		return view('auth.anunciantes-login');
   }
}
