<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Assinatura;
use App\Payment;
use App\Anunciante;
use App\Imovel;
use App\User;
use App\Plano;
use App\Admin;
use App\Gateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{


    public function __construct()
    {       
        $this->middleware(['auth:admin']);
    }

	
	/* PAGINA DASHBOARD */

    public function index()
    {
    	$assinaturas = Assinatura::count();

    	$anunciantes = Anunciante::count();

    	$imoveis = Imovel::hasStatus()->count();

   	
    	return view('admin.index', compact(['assinaturas', 'anunciantes', 'imoveis'], [$assinaturas, $anunciantes, $imoveis]));
    }


    public function updateAnunciante(Request $request)
    {

    	$usuario = Anunciante::with('assinaturas')->find($request['id']);

    	    $validate = $request->validate([
            	'tipo' => 'required|string',
            	'nome' => 'required|string|max:80|min:10', 
            	'creci' => 'nullable|string|min:6|max:7',
				'email' => 'required|string|email|unique:anunciantes,email,'.$request['id'].'|max:50' ,
				'phone_fixo' => 'required|string|max:15',
				'celular' => 'nullable|string|max:15',				
				'cep' => 'required|string|max:8',
				'logradouro' => 'required|string|max:50',
				'unidade' => 'required|string|max:8',
				'cidade' => 'required|string|max:50',
				'bairro' => 'required|string|max:50',
				'plano_id' => 'required',
				'site' => 'nullable|string|max:150',
				'sobre' => 'nullable|string|min:30',
				'cpf' => 'nullable|string|min:11|max:11|unique:anunciantes,cpf,'.$request['id'],			
	    	]);	    	
    	

	    	$assinatura = $usuario->assinaturas->last();
			$usuario->update($validate);
	    	$assinatura->plano_id = $usuario->plano_id;
	    	$assinatura->save();

	    return redirect()->back()->with('message', 'Usuário Atualizado com Sucesso.');
    	
    }

    /*Criar um Usuário*/

    public function createUser(Request $request)
    {

            $validate = $request->validate([
            	'tipo' => 'required|string',
            	'nome' => 'required|string|max:80|min:10', 
				'email' => 'required|string|email|max:50|unique:anunciantes|unique:users',
				'phone_fixo' => 'required|string|max:15',
				'celular' => 'nullable|string|max:15',				
				'cep' => 'required|string|max:8',
				'logradouro' => 'required|string|max:50',
				'unidade' => 'required|string|max:8',
				'cidade' => 'required|string|max:50',
				'bairro' => 'required|string|max:50',
				'password' => 'required|string|min:6|confirmed',
				'password_confirmation' => 'required|string|min:6',
				'plano_id' => 'required',				
	    	]);

	    	$anunciante = new Anunciante();
    		$anunciante->fill($validate); 
    		$anunciante->password = Hash::make($request['password']);
    		$anunciante->verified = true;

    		$anunciante->save();


    		/*Liberando o acesso Gratuito*/

			$hash = sha1(uniqid(mt_rand(), true));	

			/* Id customizadas*/

			$custom_id = substr($hash, 0, 8);

			$charge_id = mt_rand(100000, 999999);

    		$assinatura = Assinatura::create([
    			'anunciante_id' => $anunciante->id,
    			'plano_id' => $request['plano_id'],
    			'name' => 'Gratuita',
    			'value' => 100,
    			'status' => 'active',
    			'custom_id' => $custom_id,
    			'last_charge' => $charge_id
    		]);

    		Payment::create([
    			'charge_id' => $charge_id,
    			'payment' => 'currency',
    			'status' => 'paid',
    			'plan_id' => $request['plano_id'],
    			'anunciante_id' => $anunciante->id,
    			'assinatura_id' => $assinatura->id

    		]);
     	 
     	 $status = 'O Usuário foi cadastrado com sucesso!';

		return redirect()->back()->with('message', $status);       

    }


    /*	Consultas Painel Administrativo	*/


    public function get_options($option, $action)
    {
    	

	    	switch ($option) {

	    		case 'usuarios':

    				if( $action == 'add'){

    					$planos = Plano::all();
    					
    					return view('admin.usuarios', compact(['action', 'planos'], [$action, $planos]));

    				}else if( $action == 'anunciantes'){

    					$list = 'anunciantes';

    					$anunciantes = Anunciante::all();


    					return view('admin.usuarios', compact(['anunciantes', 'list'], [$anunciantes, $list]));

    				}else if($action == 'list_user_simple'){

     					$list = 'simples';	

    					$usuarios = User::all();   					

						return view('admin.usuarios', compact(['usuarios', 'list'], [$usuarios, $list]));

    				}else{
    					return redirect()->route('admin.dashboard')->with('errors', 'Opção Inválida');
    				}
	    				

		    			
	    			break;

	    		case 'update_anunciante':

	    			$usuario = Anunciante::with('plano')->find($action);

	    			$planos = Plano::all();

	    			return view('admin.usuarios', compact(['usuario', 'option', 'planos'], [$usuario, $option, $planos]));
	    		
	    			break;	

	    		case 'anuncios':

	    			$anuncios = Imovel::with('anunciante', 'user')->get(); 

						if( $action == 'super_destaques'){

							$super = $anuncios->where('tipo_de_anuncio', '=', 'super')->where('status', '=', '1');

	    					return view('admin.imoveis', compact(['action', 'super'], 
	    						[$action, $super]));

	    				}else if( $action == 'destaques'){

	    					$destaques = $anuncios->where('tipo_de_anuncio', '=', 'destaque')->where('status', '=', '1');
	    					return view('admin.imoveis', compact(['action', 'destaques'], [$action, $destaques])); 

	    				}else if($action == 'simples'){

	    					$simples = $anuncios->where('tipo_de_anuncio', '=', 'simples')->where('status', '=', '1');

	    					return view('admin.imoveis', compact(['action', 'simples'], [$action, $simples]));

	    				}else if($action == 'captacao'){

	    					/*Captação ainda em implantação*/

	    					$captacao = $anuncios->where('user_id', '!=', null);

	    					
	    					return view('admin.imoveis', compact(['action', 'captacao'], [$action, $captacao]));

	    				}else{

	    					return redirect()->route('admin.dashboard')->with('errors', 'Opção Inválida');

	    				}

	    			break;

	    		case 'planos':

	    				if ($action == 'gerenciar') {
	    					
	    					$planos = Plano::with('assinaturas')->get();

	    					return view('admin.planos', compact(['planos'], [$planos]));

	    				}else{
	    					return redirect()->route('admin.dashboard')->with('errors', 'Opção Inválida');
	    				}
	    		
	    			break;

	    		case 'tickets':

	    				if($action == 'listar'){
	    					echo "Listar Tickets de Suporte";
	    				}else{
	    					return redirect()->route('admin.dashboard')->with('errors', 'Opção Inválida');
	    				}
	    		
	    			break;

	    		case 'mensagens':

	    				if ($action == 'all') {
	    					echo "Listar Mensagens";
	    				}else{
	    					return redirect()->route('admin.dashboard')->with('errors', 'Opção Inválida');
	    				}

	    			break;

	    		case 'payment':

	    				if ($action == 'gerencia_net') {

							$gateways = Gateway::all();
    						return view('admin.gateway', compact(['gateways'], [$gateways]));

	    				}else if( $action == 'subscriptions'){
	    					
	    					$assinaturas = Assinatura::with(['plano', 'anunciante'])->get();

	    					return view('admin.subscription', compact(['assinaturas'], [$assinaturas]));

	    				}else if($action == 'received'){
	    					echo "Recebidos";
	    				}else{
	    					return redirect()->route('admin.dashboard');
	    				}
	    		
	    			break;

	    		case 'payment_methods':

	    				if($action == 'config'){
	    					return view('admin.gateway', compact(['action'], [$action]));
	    				}else if($action == 'Gerencia Net' || $action == 'Pag Seguro'){

	    					$method = 'update';

	    					$gateway = Gateway::where('nome', '=', $action)->first();


	    					return view('admin.gateway', compact(['method', 'gateway'], [$method, $gateway]));
	    				}

	    			break;

	    		case 'billet':

	    				if ($action == 'paid') {
	    					echo "Boletos Pagos";
	    				}else if( $action == 'canceled' ){
	    					echo "Boletos Vencidos ou Cancelados";
	    				}else if( $action == 'waiting'){
	    					echo "Aguardando Pagamento";
	    				}else{
	    					return redirect()->route('admin.dashboard');
	    				}

	    			break;			
	    		
	    		default:

	    			return redirect()->route('admin.dashboard');

	    			break;
	    	}

    	
    }

    
}
