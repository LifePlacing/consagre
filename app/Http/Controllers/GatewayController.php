<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;

class GatewayController extends Controller
{
   
    public function __construct()
    {       
        $this->middleware(['auth:admin']);
    }


    public function store(Request $request)
    {

    	if($request->nome == 'Gerencia Net'){
    		$validate = $request->validate([
				'cliente_id' => 'required|string',
				'cliente_secret' => 'required|string',
				'email' => 'nullable|email',	
				'nome' => 'string|nullable|unique:gateways',
				'token' => 'nullable|string',							
			]);

    	}else if($request->nome == 'Pag Seguro'){    		
    		$validate = $request->validate([
				'token' => 'required|string',
				'cliente_id' => 'nullable|string',
				'cliente_secret' => 'nullable|string',
				'email' => 'required|email',
				'nome' => 'string|nullable|unique:gateways',		
			]);

    	}

    	$client_sandbox = $request['cliente_sandbox'] === '1' ? true : false;

    	$gwt = new Gateway();
    	$gwt->cliente_sandbox = $client_sandbox;
    	$gwt->fill($validate);
    	$gwt->save();

    	return redirect()->route('options.admin', ['payment', 'gerencia_net'])->with('message','Pagamentos Configurado Corretamente!');

    }

    public function update(Request $request)
    {
    	
    	$gtw = Gateway::findOrFail($request['id']);

   		if($gtw->nome == 'Gerencia Net'){
    		$validate = $request->validate([
				'cliente_id' => 'required|string',
				'cliente_secret' => 'required|string',
				'email' => 'nullable|email',	
				'nome' => 'string|nullable|unique:gateways,nome,'.$request['id'],
				'token' => 'nullable|string',							
			]);

    	}else if($gtw->nome == 'Pag Seguro'){    		
    		$validate = $request->validate([
				'token' => 'required|string',
				'cliente_id' => 'nullable|string',
				'cliente_secret' => 'nullable|string',
				'email' => 'required|email',
				'nome' => 'string|nullable|unique:gateways,nome,'.$request['id'],		
			]);

    	}

    	$client_sandbox = $request['cliente_sandbox'] === '1' ? true : false;

    	$gtw->fill($validate);
    	$gtw->cliente_sandbox = $client_sandbox;

    	$gtw->update();

		return redirect()->route('options.admin', ['payment', 'gerencia_net'])->with('message','Gerenciador de Pagamentos Atualizado Corretamente!');


    }

    public function destroy(Request $request)
    {
    	$gtw = Gateway::findOrFail($request['id'])->delete();

    	return redirect()->route('options.admin', ['payment', 'gerencia_net'])->with(['message' => 'Removido com Sucesso', 'status' => 200 ]);
    }


}
