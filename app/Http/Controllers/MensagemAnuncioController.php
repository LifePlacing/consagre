<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Imovel;
use App\Mensagem;
use App\Notifications\MessageAnunciante;

class MensagemAnuncioController extends Controller
{
    public function store(Request $request)
    {
    	
        $this->validate($request, [
        	'imv_id' => 'required',
        	'mensagem' => 'required|min:10|string',
        	'nome' => 'required|string|max:200|min:5',
        	'email' => 'required|string|email|max:200',
        	'telefone' => 'required|string|min:10|max:20'

        ] );

        
        $msg = strip_tags($request['mensagem']);

        $imovel = Imovel::findOrFail($request['imv_id']);

        $mensagem = Mensagem::create([
        	'msg' => $msg,
        	'nome_remetente' => $request['nome'],
        	'email_remetente' => $request['email'],
        	'telefone' => $request['telefone'],
        	'imovel_id' => $request['imv_id'],
            'anunciante_id' => $imovel->anunciante_id 
        ]);

        $author = $mensagem->anunciante;

        $author->notify( new MessageAnunciante($mensagem));
        
        return response(200);        
    	
	}



	
}
