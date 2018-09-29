<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function show(){

    	return view('users.profile');
    }


    public function account(){
    	return view('users.account');
    }

    public function listarAnucios()
    {
        return view('users.listaImoveis');
    }

    public function avatar(Request $request)
    {

        $sessãoAvatar = $request->session()->get('user');

        $user = (int)$request->user;

        if(!empty($user) && $user != ''){

            $usuario = User::find($user);

            $diretorio = Storage::makeDirectory('imagens/users/'.$user);

            if($diretorio){
                $url = ('imagens/users/'.$user);
            }else{
                Storage::makeDirectory('imagens/users/'.$user);
                $url = ('imagens/users/'.$user);
            }
            
            $avatar = $request->foto->getClientOriginalName();
            
            $path = $request->foto->storeAs(
                $url, $avatar
            ); 

            $usuario->foto = ('storage/'.$path);
            $usuario->save();

            $status = 'Foto atualizada com sucesso';

            return back()->with('status', $status);
        }

            $warning = 'ERRO! Possivelmente sua sessão expirou';

        return back()->with('warning', $warning);
       
           
    }


}
