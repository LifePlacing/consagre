<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;

class GerenciaNetController extends Controller
{
 	
 	public function __construct()
 	{

 		$this->options = [
		    'client_id' => env('GERENCIANET_CLIENTE_ID'),
		    'client_secret' => env('GERENCIANET_CLIENTE_SECRET'),
		    'sandbox' => env('GERENCIANET_SANDBOX')
		];    

 	}


 	public function getCredentials()
 	{
 		return $this->options;
 	}


}
