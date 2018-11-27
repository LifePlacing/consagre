<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

use App\Anunciante;
use App\Plano;

use DateTime;

class GerenciaNetController extends Controller
{
 	

 public function payment(Request $request){

		$regras = [
			'plan_id' => 'required',
		];

		$msgs = [
			'plan_id.required' => 'Você precisa escolher um plano antes de gerar o boleto.'
		];
		
		$request->validate($regras, $msgs);

		$clientId = config('app.client_id_gerencianet');
		$clientSecret = config('app.client_secret_id_gerencianet');
		$sandbox = config('app.sandbox_gerencianet');


		$plano = Plano::find($request['plan_id']);


		$options = [
		    'client_id' => $clientId,
		    'client_secret' => $clientSecret,
		    'sandbox' => $sandbox
		];


	    $item_1 = [
	        'name' => $plano->nome,
	        'amount' => (int) 1,
	        'value' => (int) $plano->valor_mensal
	    ];

	    $items = [
	        $item_1
	    ];

		$body = ['items' => $items];


 		try {

 			$api = new Gerencianet( $options );

 			$charge = $api->createCharge([], $body);

	 			if ($charge["code"] == 200) {
				
				$params = ['id' => $charge["data"]["charge_id"]];


				$anunciante = Anunciante::find($request['id']);

				$telefone = preg_replace("/[^0-9]/", "", $anunciante->celular);

	 			$customer = [
	                'name' => $anunciante->nome,
	                'cpf' => $request['cpf'],
	                'email' => $anunciante->email,
	                'phone_number' => $telefone
	            ];
		
				//Formatando a data, convertendo do estino brasileiro para americano.
	            //$data_brasil = DateTime::createFromFormat('d/m/Y', $request['vencimento']);

	            $bankingBillet = [
	                'expire_at' => $request['vencimento'],
	                'customer' => $customer
	            ];

	            $payment = ['banking_billet' => $bankingBillet];

	            $body = ['payment' => $payment];
	 			
	 			$api = new Gerencianet($options);
	            $pay_charge = $api->payCharge($params, $body);

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


	public function cartao(Request $request, $anunciante_id, $plano_id){

		$anunciante = Anunciante::find($anunciante_id);

		$plano = Plano::find($plano_id);

		$sandbox = config('app.sandbox_gerencianet');

		return view('payment.cartao', compact(['anunciante', 'plano', 'sandbox'], [$anunciante, $plano, $sandbox]));
	}

	public function credito(Request $request){

		$clientId = config('app.client_id_gerencianet');
		$clientSecret = config('app.client_secret_id_gerencianet');
		$sandbox = config('app.sandbox_gerencianet');

		$options = [
		    'client_id' => $clientId,
		    'client_secret' => $clientSecret,
		    'sandbox' => $sandbox
		];

	    $item_1 = [
	        'name' => $request["descricao"],
	        'amount' => (int) $request["quantidade"],
	        'value' => (int) $request["valor"]
	    ];

	    $items = [
	        $item_1
	    ];

	    $body = ['items' => $items];

	    $api = new Gerencianet($options);

	    $charge = $api->createCharge([], $body);

	    if ($charge["code"] == 200){

	    	$params = ['id' => $charge["data"]["charge_id"]];

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
            'installments' => (int)$request["installments"],
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
	            $api = new Gerencianet($options);
	            $charge = $api->payCharge($params, $body);
	            echo json_encode($charge);

	        } catch (GerencianetException $e) {
	            print_r($e->code);
	            print_r($e->error);
	            print_r($e->errorDescription);
	        } catch (Exception $e) {
	            print_r($e->getMessage());
	        }


	    }


	}



}
