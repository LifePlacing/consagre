<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;
use App\Anunciante;
use App\Plano;
use App\Payment;
use App\Assinatura;
use DateTime;
use App\Events\CadastrarSenhaAnunciante;

use Validator;

class GerenciaNetController extends Controller
{
 	


public function __construct()
  {
   
	$this->clientId = config('app.client_id_gerencianet');
	$this->clientSecret = config('app.client_secret_id_gerencianet');
	$this->sandbox = config('app.sandbox_gerencianet');

  	$this->options = [
	    'client_id' => $this->clientId,
	    'client_secret' => $this->clientSecret,
	    'sandbox' => $this->sandbox
	];
  
  }


  public function getCredenciais()
  {
      return $this->options;
  }


 public function payment(Request $request)
 {

		$regras = [
			'plan_id' => 'required',
		];

		$msgs = [
			'plan_id.required' => 'Você precisa escolher um plano antes de gerar o boleto.'
		];
		
		$request->validate($regras, $msgs);

		/*=============Criando Plano============*/

		$plano = Plano::find($request['plan_id']);
		

		$body_plan = [
			'name' => $plano->nome, 
			'interval' => (int)$plano->interval, 
		];


		$novoPlano = $this->criarPlano($this->getCredenciais(),$body_plan);

		
		/*============produto ou serviço da assinatura=================*/

	    $item_1 = [
	        'name' => $plano->nome,
	        'amount' => (int) 1,
	        'value' => (int) $plano->valor_mensal
	    ];

	    $items = [
	        $item_1
	    ];

	    $notification = route('notification');
	    //$notification = 'http://api.webhookinbox.com/i/FKVOyq50/in/';

	    $metadata = array('notification_url'=> $notification);


		//corpo da requisição(array de produtos ou serviços)
		$body_signature = [
			'items' => $items,
			'metadata' => $metadata
		];


		//id do plano criado
		$params_signature = ['id' => (int) $novoPlano['plan_id']];


		$novaAssinatura = $this->associarAssinaturaAPlano($this->getCredenciais(),$params_signature,$body_signature);


		//id do assinatura criada
		$params_subscription = ['id' => (int)$novaAssinatura["subscription_id"]];


		/*===========Informações do cliente===================*/

		$anunciante = Anunciante::find($request['id']);

		$telefone = preg_replace("/[^0-9]/", "", $anunciante->celular);

		$customer = [
            'name' => $anunciante->nome,
            'cpf' => $request['cpf'],
            'email' => $anunciante->email,
            'phone_number' => $telefone
        ];

        $banking_billet = [
            'expire_at' => $request['vencimento'],
            'customer' => $customer
        ];

		$payment = [
			'banking_billet' => $banking_billet
		];

		$body = [
			'payment' => $payment
		];


 		try {

 			$api = new Gerencianet($this->getCredenciais());

 			$pay_charge = $api->paySubscription($params_subscription,$body);


	 		if ($pay_charge["code"] == 200) {

	 			if(empty($plano->codigo) || $plano->codigo == null ){
	 				$plano->codigo = $pay_charge['data']['plan']['id'];
	 				$plano->save();
	 			}

	 			$assinatura = Assinatura::where('custom_id','=', $pay_charge['data']['subscription_id'])->first();

	 			if(empty($assinatura) || $assinatura == null){

		 			$assinatura = Assinatura::create([
		 				'custom_id' => $pay_charge['data']['subscription_id'],
		 				'name' => $plano->nome,
		 				'plano_id' => $plano->id,
		 				'value' => (int) $plano->valor_mensal,
		 				'status' => $pay_charge['data']['status'],
		 				'anunciante_id' => $anunciante->id
		 			]);

	 			}else{
	 				$assinatura->name = $plano->nome;
	 				$assinatura->plano_id = $plano->id;
	 				$assinatura->value = (int) $plano->valor_mensal;
	 				$assinatura->status = $pay_charge['data']['status'];
	 				$assinatura->save();
	 			}

	            Payment::create([
	            	'charge_id' => $pay_charge['data']['charge']['id'],
	            	'status' => $pay_charge['data']['charge']['status'],
	            	'payment' => $pay_charge['data']['payment'],
	            	'plan_id' =>$plano->id,	
	            	'anunciante_id' => $anunciante->id,
	            	'assinatura_id' => $assinatura->id            	
	            ]); 
	            
            	$anunciante->plano_id = $plano->id;
          
        		
	            if(!$anunciante->verified) {
	            	$anunciante->verified = 1;   
        			event(new CadastrarSenhaAnunciante($anunciante));       			
        		}

        		$anunciante->save();

        		if(empty($assinatura->last_charge) || $assinatura->last_charge == null || $assinatura->last_charge !== $pay_charge['data']['charge']['id'] ){

        			$assinatura->last_charge = $pay_charge['data']['charge']['id'];
        			$assinatura->save();
        		}

	            return response()->json($pay_charge);

	 		}


 		}catch (GerencianetException $e){
        	print_r($e->code);
        	print_r($e->error);
        	print_r($e->errorDescription);
    	} catch (Exception $e) {
 			print_r($e->getMessage());
 		}
		
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


	public function associarAssinaturaAPlano($options,$params_signature,$body_signature){
		try {
			$api = new Gerencianet($options);
			$subscription = $api->createSubscription($params_signature,$body_signature);
			return $subscription['data'];
		}  catch (GerencianetException $e) {
			echo "Associar Assinatura";
	        print_r($e->code);
	        print_r($e->error);
	        print_r($e->errorDescription);
	    } catch (Exception $e) {
	    	echo "Associar Assinatura";
	        print_r($e->getMessage());
	    }

	}

	/*View do cartão de credito*/

	public function cartao(Request $request, $anunciante_id, $plano_id)
	{

		$anunciante = Anunciante::find($anunciante_id);

		if($anunciante->verified == 1){
			return redirect()->route('anunciante.login')->with('status', 'Tudo certo! Você deve receber um email para cadastrar sua senha em breve. Obrigado');
		}

		$plano = Plano::find($plano_id);

		$sandbox = config('app.sandbox_gerencianet');

		return view('payment.cartao', compact(['anunciante', 'plano', 'sandbox'], [$anunciante, $plano, $sandbox]));
	}

	public function credito(Request $request)
	{


		/*=============Criando Plano============*/

		$plano = Plano::find($request['plan_id']);
		

		$body_plan = [
			'name' => $plano->nome, 
			'interval' => (int)$plano->interval, 
		];


		$novoPlano = $this->criarPlano($this->getCredenciais(),$body_plan);


		/*============produto ou serviço da assinatura=================*/

	    $item_1 = [
	        'name' => $plano->nome,
	        'amount' => (int) 1,
	        'value' => (int) $plano->valor_mensal
	    ];

	    $items = [
	        $item_1
	    ];

	    $notification = route('notification');
	    //$notification = 'http://api.webhookinbox.com/i/FKVOyq50/in/';

	    $metadata = array('notification_url'=> $notification);

		//corpo da requisição(array de produtos ou serviços)
		$body_signature = [
			'items' => $items,
			'metadata' => $metadata
		];


		//id do plano criado
		$params_signature = ['id' => (int) $novoPlano['plan_id']];


		$novaAssinatura = $this->associarAssinaturaAPlano($this->getCredenciais(),$params_signature,$body_signature);


		//id do assinatura criada
		$params_subscription = ['id' => (int)$novaAssinatura["subscription_id"]];

	   	$customer = [
            'name' => $request["nome_cliente"],
            'cpf' => $request["cpf"],
            'phone_number' => preg_replace("/[^0-9]/", "", $request["telefone"]),
            'email' => $request["email"],
            'birth' => $request["nascimento"]
        ];

        $paymentToken = $request["payament_token"];

        $billingAddress = [
        'street' => $request["rua"],
        'number' => $request["numero"],
        'neighborhood' => $request["bairro"],
        'zipcode' => $request["cep"],
        'city' => $request["cidade"],
        'state' => $request["estado"],
    	];

    	$creditCard = [        
        'billing_address' => $billingAddress,
        'payment_token' => $paymentToken,
        'customer' => $customer
    	];

    	 $payment = [
        'credit_card' => $creditCard
    	];
    
        $body = [
            'payment' => $payment
        ];


	    try {

	            $api = new Gerencianet($this->getCredenciais());
	            $pay_charge = $api->paySubscription($params_subscription,$body);

	            if($pay_charge['code']  == 200 ){

				$anunciante = Anunciante::find($request['anunciante_id']);

	 			if(empty($plano->codigo) || $plano->codigo == null ){
	 				$plano->codigo = $pay_charge['data']['plan']['id'];
	 				$plano->save();
	 			}

	 			$assinatura = Assinatura::where('custom_id','=', $pay_charge['data']['subscription_id'])->first();

	 			if(empty($assinatura) || $assinatura == null){

		 		 $assinatura =	Assinatura::create([
		 				'custom_id' => $pay_charge['data']['subscription_id'],
		 				'name' => $plano->nome,
		 				'plano_id' => $plano->id,
		 				'value' => (int) $plano->valor_mensal,
		 				'status' => $pay_charge['data']['status'],
		 				'anunciante_id' => $anunciante->id
		 			]);

	 			}else{

	 				$assinatura->name = $plano->nome;
	 				$assinatura->plano_id = $plano->id;
	 				$assinatura->value = (int) $plano->valor_mensal;
	 				$assinatura->status = $pay_charge['data']['status'];
	 				$assinatura->save();
	 			}



		            
		         
		            if ($anunciante->plano_id == null || empty($anunciante->plano_id)) {
		            	$anunciante->plano_id = $plano->id;
		            }

		            if (isset($anunciante->cpf) && empty($anunciante->cpf)) {            	
		            

		 				$cpf = ['cpf' => preg_replace( array('/[^\d]+/'), array(''), $request['cpf'])];

		                $validator = Validator::make($cpf, [            
		                    'cpf' => 'required|unique:anunciantes'
		                ]);

		                if ($validator->fails()) {
		                    return redirect::back()
		                                ->withErrors($validator)
		                                ->withInput();
		                }else{
		                    $anunciante->cpf = $cpf['cpf'];
		                }

	           		}

	        		
		            if(!$anunciante->verified) {
		            	$anunciante->verified = 1;  
	        			event(new CadastrarSenhaAnunciante($anunciante));
	        		}

					$anunciante->save();

		            Payment::create([
		            	'charge_id' => $pay_charge['data']['charge']['id'],
		            	'status' => $pay_charge['data']['charge']['status'],
		            	'payment' => $pay_charge['data']['payment'],
		            	'plan_id' =>$plano->id,	
		            	'anunciante_id' => $anunciante->id,
		            	'assinatura_id' => $assinatura->id            	
		            ]); 

		        if(empty($assinatura->last_charge) || $assinatura->last_charge == null || $assinatura->last_charge !== $pay_charge['data']['charge']['id'] ){

        			$assinatura->last_charge = $pay_charge['data']['charge']['id'];
        			$assinatura->save();

        		}

	            	echo json_encode($pay_charge);

	        	}


	        }catch (GerencianetException $e) {
	            print_r($e->code);
	            print_r($e->error);
	            print_r($e->errorDescription);
	        } catch (Exception $e) {
	            print_r($e->getMessage());
	        }



	}




	public function notifica(Request $request)
	{

	$token = $request["notification"];
 
	$params = [
	  'token' => $token
	];
 
	try {
	    $api = new Gerencianet($this->getCredenciais());
	    $chargeNotification = $api->getNotification($params, []);

	    
	    // Conta o tamanho do array data (que armazena o resultado)
	    $i = count($chargeNotification["data"]);
	    // Pega o último Object chargeStatus
	    $ultimoStatus = $chargeNotification["data"][$i-1];
	    // Acessando o array Status
	    $status = $ultimoStatus["status"];

	    if($ultimoStatus["type"] == 'charge'){
		    // Obtendo o ID da transação    
		    $charge_id = $ultimoStatus["identifiers"]["charge_id"];
		    // Obtendo a String do status atual
		    $statusAtual = $status["current"];
	      
		    $pagamento = Payment::where('charge_id', '=', $charge_id)->first();
		    $pagamento->notification_token = $token;
		    $pagamento->status = $statusAtual;
		    $pagamento->save();
		}

		if($ultimoStatus["type"] == 'subscription'){

			$assinatura_id = $ultimoStatus["identifiers"]["subscription_id"];
			$statusAtual = $status["current"];

			$assinatura = Assinatura::where('custom_id','=', $assinatura_id)->first();
			$assinatura->status = $statusAtual;
	 		$assinatura->save();

		}

		if($ultimoStatus["type"] == 'subscription_charge'){


			$statusAtual = $status["current"];

			$charge_id = $ultimoStatus["identifiers"]["charge_id"];


			/*Identificando Assinatura e pagamentos*/
			$assinatura_id = $ultimoStatus["identifiers"]["subscription_id"];		

			$assinatura = Assinatura::where('custom_id','=', $assinatura_id)->first();

			$ultimo_pagamento = $assinatura->payments->last();

			$pagamento = Payment::where('charge_id', '=', $charge_id)->first();

			if(empty($pagamento) || $pagamento == null){

					Payment::create([
		            	'charge_id' => $charge_id,
		            	'status' => $statusAtual,
		            	'payment' => $ultimo_pagamento->payment,
		            	'plan_id' => $assinatura->plano_id,	
		            	'anunciante_id' => $ultimo_pagamento->anunciante_id,
		            	'assinatura_id' => $assinatura->id            	
		            ]); 

		            $assinatura->last_charge = $charge_id;
		            $assinatura->save();

			}else{
				$pagamento->status = $statusAtual;
				$pagamento->save();
			}
			

		}


		return response('ok', 200)->header('Content-Type', 'text/plain');

	    
		} catch (GerencianetException $e) {
		    print_r($e->code);
		    print_r($e->error);
		    print_r($e->errorDescription);
		} catch (Exception $e) {
		    print_r($e->getMessage());
		}


		return response('ok', 200)->header('Content-Type', 'text/plain');

	}



}
