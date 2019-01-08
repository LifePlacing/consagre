<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ConfirmarEmail;


class LoginController extends Controller
{
    use AuthenticatesUsers;  

    protected $redirectTo = '/';    

    public function __construct()
    {
        $this->middleware(['guest', 'revalidate', 'guest:anuncios'])->except('logout');
    }

    
    public function login(Request $request)
   {

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ],
        [
            'email.required' => 'Usuario ou Email é requerido',
            'password.required' => 'Precisa informar sua senha',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
      

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }


        $anuncios = Auth::guard('anuncios')->attempt($credentials, $request->remember);

        if ($anuncios) {
            return redirect()->intended(route('anunciante.dashboard')); 
        }

            
        return $this->sendFailedLoginResponse($request); 

   }


    public function reenvia($user)
    {
        Mail::to($user->email)->queue(new ConfirmarEmail($user));
        return back()->with('warning', 'Você precisa confirmar sua conta. Nós lhe reenviamos um novo código de ativação, por favor, verifique seu e-mail.');
    }    


    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {

            auth()->logout();
            
            return $this->reenvia($user);

        }
        
        return redirect()->intended($this->redirectPath());
    }

}
