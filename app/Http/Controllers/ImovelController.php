<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imovel;
use App\ImovelType;
use App\Categoria;
use App\User;
use App\Media;
use Illuminate\Support\Facades\Auth;

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
        
        return view('app.steps.create', compact(['valor', 'imovel', 'categorias', 'tipos']));
    }

    public function postCreateStep1(Request $request)
    {

        /*Validando os dados */

        $validatedData = $request->validate([
            'cpf' => 'required',
            'phone' => 'required',
            'meta'=> 'required',
            'banheiros' => 'required|numeric',
            'quartos' => 'required|numeric',
            'suites' => '',
            'garagem' => 'numeric',
            'area_util' => 'required|numeric',
            'area_total' => 'required|numeric',            
            'estado'=>'string|required',
            'cidade' => 'string|required',
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
            $usuario->name = $request['name'];
            $usuario->cpf = preg_replace( array('/[^\d]+/'), array(''), $request['cpf']);
            $usuario->phone =  preg_replace( array('/[^\d]+/'), array(''), $request['phone']);

            $usuario->save();
        }    

/* ==================== Cadastro no novo imovel =========================== */
        
         if (empty($request->session()->get('imovel'))){ 

                $imovel = new Imovel();
                $imovel->user_id = $usuario->id;
                $imovel->fill($validatedData);

             /* DEFININDO FORMATO PRECO COMO INTEIRO */
                $preco = str_replace(',','.',str_replace('.','',$request['preco']));
                $valor = number_format( sprintf( '%f', $preco ), 2, '', '' );        
                $imovel->preco = (int)$valor;

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
                $valor = number_format( sprintf( '%f', $preco ), 2, '', '' );        
                $imovel->preco = (int)$valor;

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
        'titulo' => 'required|string',
        'descricao' => 'required|string',
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

            $imv = Imovel::create([
                'user_id' => $tmp->user_id,
                'titulo' => $tmp->titulo,
                'meta' => $tmp->meta,
                'imovel_type_id' => $tmp->imovel_type_id,
                'categoria_id' => $tmp->categoria_id,
                'cep' => $tmp->cep,
                'cidade' => $tmp->cidade,
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
                'descricao' => $tmp->descricao
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


    public function show($id)
    {
       
    }


    public function edit($id)
    {
        
    }


    public function update(Request $request, $id)
    {
       
    }


    public function destroy($id)
    {
        
    }

    
}
