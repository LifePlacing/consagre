<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VerifyUser;
use App\Plano;
use App\Assinatura;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class PlanosController extends Controller
{


    public function getCredenciais()
    {
        $options = consultaCredenciais('Gerencia Net');
        
        return $options;
    }
    
    public function planos($token){

        $verifyAnunciante = VerifyUser::where('token', $token)->first();

        $planos = Plano::all();

        if(isset($verifyAnunciante) ){

            $anunciante = $verifyAnunciante->anunciante;

            $expired = false;
    	
    		if (isset($anunciante->plano_id)) {
    			$expired = true;
    		}

            if($anunciante->password !== null || !empty($anunciante->password)){
                return redirect()->route('anunciante.login')->with('status', ' Acesse seu painel para anunciar seus imoveis.');
            }

            if($anunciante->verified == 1 && empty($anunciante->password)){
                return redirect()->route('anunciante.login')->with('status', 'Tudo certo! Você deve receber um email para cadastrar sua senha em breve. Obrigado');
            }

        	return view('payment.plano', compact(['anunciante', 'planos', 'expired'], [$anunciante, $planos, $expired]));
    	}

	}


    public function create(Request $request)
    {

        $busca = Plano::where('nome', '=', $request->nome)->first();

        $validate = $request->validate([
            'nome' => 'required|string|unique:planos', 
            'quant_anuncios' => 'required|numeric', 
            'super_destaques' => 'required|numeric', 
            'destaques' => 'required|numeric', 
            'valor_mensal' => 'nullable|string', 
        ]);


        $body = [
          'name' => $request->nome, 
          'interval' => (int)$request->interval, 
          'repeats' => $request->repeats 
        ];        

    
        if(empty($busca) || $busca == null){

            $novoPlano = $this->criarPlano($this->getCredenciais(),$body);

            $plano = new Plano;

            $plano->codigo = $novoPlano['plan_id'];
            $plano->nome = $request->nome;
            $plano->quant_anuncios = $request->quant_anuncios;
            $plano->super_destaques = $request->super_destaques;
            $plano->destaques = $request->destaques;
            $plano->valor_mensal = (int) soNumero($request->valor_mensal);
            $plano->interval = (int)$request->interval;

            $plano->save();

        }else{
            return response()->json(['message' => 'Já existe um Plano com este nome.', 'status' => 403 ], 403);
        }    


        return response()->json(['message' => 'Plano Cadastrado com Sucesso', 'status' => 200 ], 200);

    }

    public function update(Request $request)
    {

        $plano = Plano::find( $request['id'] );

        $validate = $request->validate([
            'nome' => 'required|string|unique:planos,nome,'.$request['id'],
            'quant_anuncios' => 'required|numeric',
            'super_destaques' => 'required|numeric', 
            'destaques' => 'required|numeric', 
            'valor_mensal' => 'required|numeric',
        ]);
       

        $plano->update($validate);

        return response()->json(['message' => 'Plano Cadastrado com Sucesso', 'status' => 200 ], 200);
    }

    public function delete(Request $request)
    {
        //$res = Plano::findOrFail($request['id'])->delete(); 
        $res = Plano::with(['anunciantes', 'assinaturas'])->findOrFail($request['id']); 

        if(!$res)
        {
            $data=['status'=>'500', 'message'=>'Falha na consulta!'];
            return redirect()->route('options.admin', ['planos', 'gerenciar'])->with($data);             
        }
        if($res->anunciantes->count() > 0 || $res->assinaturas->count() > 0)
        {
            return redirect()->route('options.admin', ['planos', 'gerenciar'])->with(['message' => 'Não foi possivel remover. Este plano tem usuários ou assinaturas vinculados a ele.', 'status' => 500 ]);
        }


        /*DELETANDO O PLANO*/

        $res->delete();

        return redirect()->route('options.admin', ['planos', 'gerenciar'])->with(['message' => 'Plano Removido com Sucesso', 'status' => 200 ]);
        
    }


    public function criarPlano($options,$body_plan){
        try {
            $api = new Gerencianet($options);
            $plan = $api->createPlan([],$body_plan);
            return $plan['data'];
        }  catch (GerencianetException $e) {
            echo "Criar Plano";
            print_r($e->code);
            print_r($e->error);
            print_r($e->errorDescription);
        } catch (Exception $e) {
            echo "Criar Plano";
            print_r($e->getMessage());
        }
    }



}
