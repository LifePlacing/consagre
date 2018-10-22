<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\VerifyMail;


class LoginController extends Controller
{
    use AuthenticatesUsers;  

    protected $redirectTo = '/';    

    public function __construct()
    {
        $this->middleware(['guest', 'revalidate'])->except('logout');
    }


    public function reenvia($user)
    {
        Mail::to($user->email)->send(new VerifyMail($user));
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
