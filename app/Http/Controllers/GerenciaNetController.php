<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

use App\Anunciante;
use App\Plano;
use App\Payment;
use DateTime;

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

		$plano = Plano::find($request['plan_id']);

	    $item_1 = [
	        'name' => $plano->nome,
	        'amount' => (int) 1,
	        'value' => (int) $plano->valor_mensal
	    ];

	    $items = [
	        $item_1
	    ];

	    $notification = route('notification');

	    $metadata = array('notification_url'=> $notification);

		$body = [
			'items' => $items,
			'metadata' => $metadata
		];


 		try {

 			$api = new Gerencianet($this->getCredenciais());

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
	 			
	 			$api = new Gerencianet($this->getCredenciais());
	            $pay_charge = $api->payCharge($params, $body);	

	            Payment::create([
	            	'charge_id' => $pay_charge['data']['charge_id'],
	            	'status' => $pay_charge['data']['status'],
	            	'payment' => $pay_charge['data']['payment'],
	            	'plan_id' =>$plano->id,	
	            	'anunciante_id' => $anunciante->id            	
	            ]); 
        

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



	/*View do cartão de credito*/

	public function cartao(Request $request, $anunciante_id, $plano_id)
	{

		$anunciante = Anunciante::find($anunciante_id);

		$plano = Plano::find($plano_id);

		$sandbox = config('app.sandbox_gerencianet');

		return view('payment.cartao', compact(['anunciante', 'plano', 'sandbox'], [$anunciante, $plano, $sandbox]));
	}

	public function credito(Request $request)
	{

	    $item_1 = [
	        'name' => $request["descricao"],
	        'amount' => (int) $request["quantidade"],
	        'value' => (int) $request["valor"]
	    ];

	    $items = [
	        $item_1
	    ];

	    $notification = route('notification');

	    $metadata = array('notification_url' => $notification);

	    $body = ['items' => $items, 'metadata' => $metadata];

	    $api = new Gerencianet($this->getCredenciais());

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
	            $api = new Gerencianet($this->getCredenciais());
	            $charge = $api->payCharge($params, $body);

	           	Payment::create([
	            	'charge_id' => $charge['data']['charge_id'],
	            	'status' => $charge['data']['status'],
	            	'payment' => $charge['data']['payment'],
	            	'plan_id' =>$request['plan_id'], 
	            	'anunciante_id' => $request['anunciante_id']           	
	            ]); 

	            echo json_encode($charge);

	        }catch (GerencianetException $e) {
	            print_r($e->code);
	            print_r($e->error);
	            print_r($e->errorDescription);
	        } catch (Exception $e) {
	            print_r($e->getMessage());
	        }


	    }


	}




	public function notification(Request $request)
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
	    // Obtendo o ID da transação    
	    $charge_id = $ultimoStatus["identifiers"]["charge_id"];
	    // Obtendo a String do status atual
	    $statusAtual = $status["current"];
	    
	    // Com estas informações, você poderá consultar sua base de dados e atualizar o status da transação especifica, uma vez que você possui o "charge_id" e a String do STATUS
	  
	    $pagamento = Payment::where('charge_id', '=', $charge_id)->first();
	    $pagamento->notification_token = $token;
	    $pagamento->status = $statusAtual;	   
	    
		} catch (GerencianetException $e) {
		    print_r($e->code);
		    print_r($e->error);
		    print_r($e->errorDescription);
		} catch (Exception $e) {
		    print_r($e->getMessage());
		}

	}



}
