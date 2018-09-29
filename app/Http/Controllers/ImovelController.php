<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imovel;
use App\ImovelType;
use App\Categoria;
use App\User;
use App\Media;
use App\Cidade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Validator;

class ImovelController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }


    public function index()
    {
        return view('app.anunciante');        
    }

/*============= Passos do Cadastro de imovel ====================*/

/* Primeiro Passo GET & POST */

    public function createStep1(Request $request)
    {
        $valor = 16.66;
        $imovel = $request->session()->get('imovel');
        $categorias = Categoria::pluck('id', 'name');
        $tipos = ImovelType::pluck('id', 'tipo');

        /*======== Verificação da quantidade de anuncios=========*/
            $user = Auth::user();
            $quant = $user->imovels()->count();           
            
        
        return view('app.steps.create', compact(['valor', 'imovel', 'categorias', 'tipos', 'quant'], [$valor, $imovel, $categorias, $tipos, $quant]));
    }

    public function postCreateStep1(Request $request)
    {

        /*Validando os dados */

        $validatedData = $request->validate([
            'phone' => 'required',
            'meta'=> 'required',
            'banheiros' => 'required|numeric',
            'quartos' => 'required|numeric',
            'area_util' => 'required|numeric',
            'area_total' => 'required|numeric',            
            'estado'=>'string|required',
            'localidade' => 'string|required',
            'bairro' => 'string|required',
            'logradouro' => 'string|required',
            'unidade' => 'required',
            'cep' => 'required|string|max:8|regex:/^[0-9]{8}$/', 
            'preco' => 'required',           
            'imovel_type_id' => 'required',
            'categoria_id' => 'required',                        
        ]);

        

       if (Auth::check()) 
        { 
            $usuario = Auth::user();

            if(empty($usuario->cpf) || $usuario->cpf == null ){

                $cpf = ['cpf' => preg_replace( array('/[^\d]+/'), array(''), $request['cpf'])];

                $validator = Validator::make($cpf, [            
                    'cpf' => 'required|unique:users'
                ]);

                if ($validator->fails()) {
                    return redirect('/anunciar')
                                ->withErrors($validator)
                                ->withInput();
                }else{
                    $usuario->cpf = $cpf['cpf'];
                }

            } 

            $usuario->name = $request['name'];            
            $usuario->phone =  preg_replace( array('/[^\d]+/'), array(''), $request['phone']);  
            $usuario->save();
        }    

/* ==================== Cadastro no novo imovel =========================== */
        
         if (empty($request->session()->get('imovel'))){ 

                $imovel = new Imovel();
                $imovel->user_id = $usuario->id;
                $imovel->fill($validatedData);

                $imovel->localidade = $request['localidade'];

                if (isset($request['suites']) && !empty($request['suites'])) {
                    
                    $imovel->suites = $request['suites'];
                }


                if (isset($request['garagem']) && !empty($request['garagem'])) {
                    
                    $imovel->garagem = $request['garagem'];
                }

                /* DEFININDO FORMATO IPTU COMO MONETÁRIO */

                if(isset($request['iptu']) && !empty($request['iptu'])){

                $iptu = str_replace(',','.',str_replace('.','',$request['iptu']));

                $valorIptu = number_format( $iptu, 2, '.', '' );
                
                $imovel->iptu = floatval($valorIptu);

                }

                if(isset($request['condominio']) && !empty($request['condominio'])){

                    $condominio = str_replace(',','.',str_replace('.','',$request['condominio']));

                    $valorCondominio = number_format( $condominio, 2, '.', '' );
                    
                    $imovel->condominio = floatval($valorCondominio);

                }


             /* DEFININDO FORMATO PRECO COMO MONETÁRIO */

                $preco = str_replace(',','.',str_replace('.','',$request['preco']));

                $valor = number_format( $preco, 2, '.', '' );
                
                $imovel->preco = floatval($valor);


            /* LEMBRAR DE CONVERTER O VALOR DO PREÇO PARA DECIMAL */    

                $imovel->area_util = floatval($request['area_util']);
                $imovel->area_total = floatval($request['area_total']);
                    
                /* Atualiza a sessão do imovel */
                $request->session()->put('imovel', $imovel);       

         } else { 

             $imovel  =  $request->session()->get('imovel');
             $imovel->user_id = $usuario->id;  
             $imovel->fill($validatedData); 
            
            /* DEFININDO FORMATO PRECO COMO INTEIRO */
                $preco = str_replace(',','.',str_replace('.','',$request['preco']));

                $valor = number_format( $preco, 2, '.', '' );
                
                $imovel->preco = floatval($valor);

            /* LEMBRAR DE CONVERTER O VALOR DO PREÇO PARA DECIMAL */ 
                $imovel->area_util = floatval($request['area_util']);
                $imovel->area_total = floatval($request['area_total']);                    
            
            /* Atualiza a sessão do imovel */
                $request->session()->put('imovel', $imovel);
         } 


        return redirect('/anunciar/anunciar-step2');
    
    }



/* Segundo Passo GET & POST */

    public function createStep2(Request $request)
    {
        $imovel = $request->session()->get('imovel'); 
        $percent = round((1/3)*100, 1); 
        $valor = 16.66 + ($percent);     
        return view('app.steps.details', compact(['imovel', 'valor'], [$imovel, $valor]));
    }


    public function postCreateStep2(Request $request)
    {

        $validatedData = $request->validate([
        'titulo' => 'required|string|min:5|max:50',
        'descricao' => 'required|string|min:50',
        ]);
        
        

        if (empty($request->session()->get('imovel'))) {
            
            return back()->withErrors('Ocorreu um erro.');
           
        }else{

            $imovel  =  $request->session()->get('imovel');

            $imovel->fill($validatedData);

            /* Atualiza a sessão do imovel */
            $request->session()->put('imovel', $imovel);

            return redirect('/anunciar/finish');

        }

    }

   public function createFinish(Request $request)
    {
        $imovel = $request->session()->get('imovel'); 
        $percent = round((3/3)*100, 1); 
        $valor = 16.66 + ($percent); 

        if (empty($imovel->medias)) {
           
           return back()->withErrors('Você esqueceu de enviar suas imagens');
        }

        return view('app.steps.finish', compact(['imovel', 'valor'], [$imovel, $valor]));
    } 


    public function store(Request $request)
    {

        if (!empty($request->session()->get('imovel'))) {

            $tmp = $request->session()->get('imovel');

        /*============== Verifica se existe a cidade ==========*/    

            $city = DB::table('cidades')->where('nome','=', $tmp->localidade)->first();

            $cidadeImovel = '';

            if (empty($city)) {
                
                /* ============= Criando slug da cidade ==============*/

                $cidade  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $tmp->localidade));

                $slugCidade =  strtolower($cidade);       

                $slug =  str_replace(' ', '_', $slugCidade); 

                $cidadeImovel = Cidade::create([
                    'nome' => $tmp->localidade,
                    'slug' => $slug
                ]);

            }else{
                    $cidadeImovel = $city;
            }

            /* ======== Identificação Codigo do imovel ======= */

                $uid = mt_rand(100000, 999999);
                $uuid = $uid.':'.uniqid(); 

                                

            $imv = Imovel::create([
                'user_id' => $tmp->user_id,
                'titulo' => $tmp->titulo,
                'meta' => $tmp->meta,
                'imovel_type_id' => $tmp->imovel_type_id,
                'categoria_id' => $tmp->categoria_id,
                'cep' => $tmp->cep,                
                'estado' => $tmp->estado,
                'bairro' => $tmp->bairro,
                'logradouro' => $tmp->logradouro,
                'unidade' => $tmp->unidade,
                'quartos' => $tmp->quartos,
                'garagem' => $tmp->garagem,
                'banheiros' => $tmp->banheiros,
                'suites' => $tmp->suites,
                'area_util' => $tmp->area_util,
                'area_total' => $tmp->area_total,
                'preco' => $tmp->preco,
                'descricao' => $tmp->descricao,
                'cidade_id' => $cidadeImovel->id,
                'codigo' => $uuid,
                'iptu' => $tmp->iptu,
                'condominio' => $tmp->condominio
            ]);   

     /*================Salvando Medias do imovel=================*/
           
                foreach ($tmp->medias as $key => $m) {
                    $media = new Media();            
                    $media->imovel_id = $imv->id;
                    $media->source = $m;
                    $media->position = $key;
                    $media->save();
                }

            $request->session()->forget('imovel');

            return redirect()->route('home');
            
            
        }else{
            abort(403, 'Tentativa não autorizada');         

        }  

    }

    
}
