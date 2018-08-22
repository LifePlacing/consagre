<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;  

    protected $redirectTo = '/';    

    public function __construct()
    {
        $this->middleware(['guest', 'revalidate'])->except('logout');
    }


    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'Você precisa confirmar sua conta. Nós lhe enviamos um código de ativação, verifique seu e-mail.');
        }
        return redirect()->intended($this->redirectPath());
    }

}
