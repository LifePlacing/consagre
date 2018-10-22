<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Imovel;
use Cache;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}


    /*========= Painel do usuário ===========*/
    public function index()
    {
        /*if (!Gate::allows('isProprietario')) {
            
            abort(404, "Não permitido");
        }*/

        $user = Auth::user();

        $imoveis_user = Imovel::where('user_id', '=', $user->id)->get();

        $ativos = $imoveis_user->where('status', '=', '1');


        $pendentes = $imoveis_user->where('status', '=', '0');

        return view('users.index', compact(['ativos', 'pendentes'], [$ativos, $pendentes]) );
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


    public function getUpdate($id){

        abort(403, 'Solicitação não permitida');
        
        return redirect()->route('home');
    }


    public function update($id, Request $request)
    {

        $usuario = User::findOrFail($id);


       if (empty($usuario->email) || $usuario->email == null )
       {
            abort(403, 'Informações do usuario não encontradas!');
       }

        $val = [
            'phone' => $request['phone'],
            'sobre' => $request['sobre'],
            'name' => $request['name'],
            'sobrenome' => $request['sobrenome'],
        ];

           if(empty($usuario->cpf) || $usuario->cpf == null )
            {
                $val += ['cpf' => preg_replace( array('/[^\d]+/'), array(''), $request['cpf'])];

                $validator = Validator::make($val, [                
                    'phone' => 'required|string|min:11|max:15',
                    'sobre' => 'string|min:30|max:100',
                    'name' => 'required|string|min:5| max:50',
                    'sobrenome' => 'string|min:5',
                    'cpf' => 'required|string|min:11|max:11|unique:users'
                ]);


            }else{
                $validator = Validator::make($val, [                
                    'phone' => 'required|string|min:11|max:15',
                    'sobre' => 'string|min:30|max:100',
                    'name' => 'required|string|min:5| max:50',
                    'sobrenome' => 'string|min:5'                    
                ]);
            }


            if ($validator->fails()) {
                return back()->withErrors($validator)
                            ->withInput();
            }else{

                $usuario->fill($val);
                $usuario->save();

                $status = 'Dados atualizados com sucesso!';

                return back()->with('status', $status);

            }

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
