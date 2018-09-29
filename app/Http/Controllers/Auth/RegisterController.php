<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Mail\ConfirmarEmail;
use App\VerifyUser;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{


    use RegistersUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'sexo' => 'required|string',
        ]);
    }


    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), 
            'sexo' => $data['sexo'], 
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new ConfirmarEmail($user));

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();

                $status = "Seu e-mail foi confirmado. Agora você pode fazer o login.";
            }else{
                $status = "Seu e-mail já foi verificado. Agora você pode fazer o login.";
            }
        }else{

            return redirect('/login')->with('warning', "Desculpe seu email não pode ser identificado..");
        }
 
        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'Nós lhe enviamos um código de ativação. Verifique seu e-mail e clique no link para confirmar.');
    }    


}
