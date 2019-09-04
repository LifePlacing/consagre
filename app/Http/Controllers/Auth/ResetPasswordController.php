<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{

    use ResetsPasswords;


    protected $redirectTo = '/usuario/profile/home';


    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker()
    {    
       
        return Password::broker('anunciantes');       
        
    }

}
