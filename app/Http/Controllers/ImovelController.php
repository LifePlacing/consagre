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


    /* ============= Passos do Cadastro de imovel ==================== */

    
    public function createStep1(Request $request)
    {
        $valor = 16.66;
        $imovel = $request->session()->get('imovel');
        $categorias = Categoria::pluck('id', 'name');
        $tipos = ImovelType::pluck('id', 'tipo');

        /*======== Verificação da quantidade de anuncios=========*/
            $user = Auth::user();

            $quant = $user->imovels()->count();  

            $plano = ''; 

            if(isset($user->plano)){

                $plano = $user->plano; 

                if ($quant >= $plano->quant_anuncios) {
                   return redirect::back()->withErrors(['msg', 'Você atigiu o limite de anuncios permitido pelo plano']);
                }

            }          
            
        
        return view('app.steps.create', compact(['valor', 'imovel', 'categorias', 'tipos', 'quant', 'plano'], [$valor, $imovel, $categorias, $tipos, $quant, $plano]));
    }

    public function postCreateStep1(Request $request)
    {


            $validatedData = $request->validate([
                'phone' => 'required',
                'meta'=> 'required',
                'banheiros' => 'required|numeric',
                'quartos' => 'required|numeric',
                'area_util' => 'required|numeric',                           
                'estado'=>'string|required',
                'localidade' => 'string|required',
                'bairro' => 'string|required',
                'logradouro' => 'string|required',
                'unidade' => 'required',
                'cep' => 'required|string|max:8|regex:/^[0-9]{8}$/', 
                'preco_venda' => 'nullable',           
                'preco' => 'nullable', 
                'preco_aluguel' => 'nullable',          
                'imovel_type_id' => 'required',
                'periodo' => 'nullable|string',
                'categoria_id' => 'required',                        
            ]);        


        

       if (Auth::check()) 
        { 
            $usuario = Auth::user();

            if(isset($usuario->cpf) && empty($usuario->cpf) || $usuario->cpf == null )
            {

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

            if(isset($usuario->name)){
                $usuario->name = $request['name']; 
            }elseif (isset($usuario->nome) && empty($usuario->nome)) {
                $usuario->nome = $request['name'];
            }  

            if(isset($usuario->phone)){
                $usuario->phone =  preg_replace( array('/[^\d]+/'), array(''), $request['phone']);
            }elseif(isset($usuario->celular)){
                $usuario->celular =  preg_replace( array('/[^\d]+/'), array(''), $request['phone']);
            }

            $usuario->save();
        }    

        
         if (empty($request->session()->get('imovel')))
         { 

                $imovel = new Imovel();
                $imovel->user_id = $usuario->id;
                $imovel->fill($validatedData);

                $imovel->localidade = $request['localidade'];

                if (isset($request['suites']) && !empty($request['suites'])) {
                    
                    $imovel->suites = $request['suites'];
                }

                if (isset($request['area_total'])) {
                    $imovel->area_total = $request['area_total'];
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


                if(isset($request['preco_venda']) || isset($request['preco']) ){

                     /* DEFININDO FORMATO PRECO COMO MONETÁRIO */


                    /* Preco sem comissão ou  Preço Mensal do Aluguel */

                        $preco = str_replace(',','.',str_replace('.','',$request['preco_venda']));

                        $valor = number_format( $preco, 2, '.', '' ); 

                        $imovel->preco_venda = floatval($valor);



                    /* Preco com comissão ou  Preço Anual do Aluguel */


                        $simbol = array('R$');                

                        $str = str_replace($simbol, '', $request['preco']); 

                        $limpa = substr($str, 2);                               

                        $total = str_replace(',','.',str_replace('.','',$limpa));         
                        
                        
                        $t_preco = number_format( $total, 2, '.', '' );


                        $imovel->preco = floatval($t_preco);                               

                }else{
                        $preco = str_replace(',','.',str_replace('.','',$request['preco_aluguel']));

                        $valor = number_format( $preco, 2, '.', '' );                       

                        $imovel->preco_aluguel = floatval($valor);
                    
                }

            
            /* LEMBRAR DE CONVERTER O VALOR DO PREÇO PARA DECIMAL */    

                $imovel->area_util = floatval($request['area_util']);
                $imovel->area_total = floatval($request['area_total']);
                    
                /* Atualiza a sessão do imovel */
                $request->session()->put('imovel', $imovel);       

         }else{ 

             $imovel  =  $request->session()->get('imovel');
             $imovel->user_id = $usuario->id;  
             $imovel->fill($validatedData); 

            if(isset($request['preco_venda']) || isset($request['preco']) ){

             /* DEFININDO FORMATO PRECO COMO MONETÁRIO */


            /* Preco sem comissão ou  Preço Mensal do Aluguel */

                $preco = str_replace(',','.',str_replace('.','',$request['preco_venda']));

                $valor = number_format( $preco, 2, '.', '' );                
                
                $imovel->preco_venda = floatval($valor);


            /* Preco com comissão ou  Preço Anual do Aluguel */

                $simbol = array('R$');                

                $str = str_replace($simbol, '', $request['preco']); 

                $limpa = substr($str, 2);                               

                $total = str_replace(',','.',str_replace('.','',$limpa));         
                
                
                $t_preco = number_format( $total, 2, '.', '' );


                $imovel->preco = floatval($t_preco);                             

            }else{

                        /* Preco do Aluguel Temporário*/

                        $preco = str_replace(',','.',str_replace('.','',$request['preco_aluguel']));

                        $valor = number_format( $preco, 2, '.', '' );                       

                        $imovel->preco_aluguel = floatval($valor);
                
            }
            

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
        
        

        if (empty($request->session()->get('imovel'))){
            
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

        if (empty($imovel->medias)){           
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

            if (empty($city)){
                
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

           
                $imv = new Imovel;

                $imv->user_id = $tmp->user_id;
                $imv->titulo = $tmp->titulo;
                $imv->meta = $tmp->meta;
                $imv->imovel_type_id = $tmp->imovel_type_id;
                $imv->categoria_id = $tmp->categoria_id;
                $imv->cep = $tmp->cep;                
                $imv->estado = $tmp->estado;
                $imv->bairro = $tmp->bairro;
                $imv->logradouro = $tmp->logradouro;
                $imv->unidade = $tmp->unidade;
                $imv->quartos = $tmp->quartos;
                $imv->garagem = $tmp->garagem;
                $imv->banheiros = $tmp->banheiros;
                $imv->suites = $tmp->suites;
                $imv->area_util = $tmp->area_util;
                $imv->area_total = $tmp->area_total;
                $imv->descricao = $tmp->descricao;
                $imv->cidade_id = $cidadeImovel->id;
                $imv->codigo = $uuid;
                $imv->iptu = $tmp->iptu;
                $imv->condominio = $tmp->condominio;               


                if(isset($tmp->preco_aluguel)){
                    $imv->preco_aluguel = $tmp->preco_aluguel;
                    $imv->periodo_aluguel = $tmp->periodo;
                }else{
                    $imv->preco = $tmp->preco;
                    $imv->preco_venda = $tmp->preco_venda;
                }

               $imv->save();

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

    public function delete(Request $request)
    {

        (int)$id = $request['id'];

        $imovel = Imovel::find($id);

        $medias = $imovel->media;

            foreach ($medias as $m) {
                
                if(file_exists(public_path($m->source) ) ){
                    unlink(public_path($m->source)); 
                }
                
                $m->delete();
            }


        $imovel->delete();

        return back()->with('success', 'Anúncio removido com sucesso!');
       
    }

    


}