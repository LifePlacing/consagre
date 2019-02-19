<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Anunciante;
use App\Imovel;
use App\Cidade;
use App\Media;
use App\ImovelType;
use App\Categoria;
use App\Xml;
use Redirect;
use Carbon\Carbon;


class ImovelAnunciantesController extends ImovelController
{
    public function __construct()
    {
         $this->middleware(['auth:anuncios', 'check.assinatura']);         
    }


    public function adicionarStep1(Request $request){

    	if($request->session()->exists('imovel')){    		
    		$request->session()->forget('imovel');
    	}

        $imovel = $request->session()->get('imovel');
        $categorias = Categoria::pluck('id', 'name');
        $tipos = ImovelType::pluck('id', 'tipo');


        /*======== Verificação da quantidade de anuncios=========*/
           

	        $anunciante = Auth::user();

            $quant = $anunciante->imovels()->withTrashed()->where('tipo_de_anuncio', '=', 'simples')->count();  

            $dest = $anunciante->imovels()->withTrashed()->where('tipo_de_anuncio', '=', 'destaque')->count(); 
             
            $super = $anunciante->imovels()->withTrashed()->where('tipo_de_anuncio', '=', 'super')->count();

            $plano = ''; 

            if(isset($anunciante->plano)){

                $plano = $anunciante->plano; 

                if( $plano->quant_anuncios > 0 ){

                    if ($quant >= $plano->quant_anuncios && $dest >= $plano->destaques && $super >= $plano->super_destaques) {
                       return Redirect::back()->withErrors(['msg', 'Você atigiu o limite de anuncios permitido pelo plano']);
                    }

                }

                return view('users.anunciantes.anuncios.step1', compact([ 'imovel', 'categorias', 'tipos', 'quant', 'plano', 'dest', 'super'], [$imovel, $categorias, $tipos, $quant, $plano, $dest, $super]));

            }

             


    }


    public function postCreateStep1(Request $request)
    {


            $anunciante = Auth::user();

            if(!contaAnuncios($anunciante, $request->tipo_de_anuncio) || contaAnuncios($anunciante, $request->tipo_de_anuncio) == false ){

                return back()->withErrors("Verifique seu plano: Talvez tenha excedido o limite de anuncios $request->tipo_de_anuncio");

            }
            

    	    $validatedData = $request->validate([                
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
                'preco_venda' => 'required',           
                'preco' => 'required',           
                'imovel_type_id' => 'required',
                'categoria_id' => 'required',
                'tipo_de_anuncio' => 'required'                       
            ]); 


            if (empty($request->session()->get('imovel')))
         	{ 
                $imovel = new Imovel();
              	$imovel->anunciante_id = $anunciante->id;	
                $imovel->fill($validatedData);

                /*Itens que não passam na validação*/

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

                /*Areas do imóvel*/

                $imovel->area_util = floatval($request['area_util']);
                $imovel->area_total = floatval($request['area_total']);
                    
                /* Atualiza a sessão do imovel */
                $request->session()->put('imovel', $imovel);
         	}else{

             	$imovel  =  $request->session()->get('imovel');
             	$imovel->anunciante_id = Auth::user()->id;
             	$imovel->fill($validatedData);           


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

            /* LEMBRAR DE CONVERTER O VALOR DO PREÇO PARA DECIMAL */ 

                $imovel->area_util = floatval($request['area_util']);
                $imovel->area_total = floatval($request['area_total']);                    
            
            /* Atualiza a sessão do imovel */

                $request->session()->put('imovel', $imovel);

         	}       

    	return redirect('anunciante/novoanuncio/imagens');

    }


    public function adicionarStep2(Request $request)
    {

    	if($request->session()->get('imovel') !== null ){
    		$imovel = $request->session()->get('imovel');
    		return view('users.anunciantes.anuncios.step2', compact(['imovel'], [$imovel]));
    	}else{
    		return Redirect::back()->withErrors(['Você não pode seguir sem antes cadastrar os dados do imóvel']);
    	} 	  

    }


    public function postCreateStep2(Request $request)
    {



        $validatedData = $request->validate([
        'titulo' => 'required|string|min:5|max:50',
        'descricao' => 'required|string|min:50',
        ]);

		if (empty($request->session()->get('imovel')) || $request->session()->get('imovel') == null){
            
            abort(403, 'Tentativa não autorizada');
           
        }

        	$tmp  =  $request->session()->get('imovel');
        	$tmp->fill($validatedData);

	        if (empty($tmp->medias)){           
	           return back()->withErrors('Você esqueceu de enviar suas imagens!');
	        }

        	/* Atualiza a sessão do imovel */
            //$request->session()->put('imovel', $imovel);

            $city = Cidade::where('nome','=', $tmp->localidade)->first();
            

            if (empty($city) || $city == null){
                
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

            if(!contaAnuncios(Auth::user(), $tmp->tipo_de_anuncio) || contaAnuncios(Auth::user(), $tmp->tipo_de_anuncio) == false ){

                return back()->withErrors("Verifique seu plano: Talvez tenha excedido o limite de anuncios $request->tipo_de_anuncio");

            }



	            $imv = Imovel::create([
	                'anunciante_id' => $tmp->anunciante_id,
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
	                'preco_venda' => $tmp->preco_venda,
	                'descricao' => $tmp->descricao,
	                'cidade_id' => $cidadeImovel->id,
	                'codigo' => $uuid,
	                'iptu' => $tmp->iptu,
	                'condominio' => $tmp->condominio,
                    'tipo_de_anuncio' => $tmp->tipo_de_anuncio,
                    'status' => true
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

        return redirect()->route('anunciantes.listar.anuncios')->with('success', 'Anúncio cadastrado com sucesso!');
        	      

    }


    public function listarAnuncios()
    {
        $anunciante = Auth::user();

        $imoveis = Imovel::where('anunciante_id', '=', $anunciante->id)->orderBy('created_at', 'desc')->get();       

        $simples = $imoveis->where('tipo_de_anuncio', '=', 'simples');
        $destaques = $imoveis->where('tipo_de_anuncio', '=', 'destaque');
        $super = $imoveis->where('tipo_de_anuncio', '=', 'super');

        return view('users.anunciantes.anuncios.listar', compact(['imoveis','simples', 'destaques', 'super'], [$imoveis, $simples, $destaques, $super]));
    }


    public function delete(Request $request)
    {

        (int)$id = $request['id'];

        //$imovel = Imovel::withTrashed()->find($id);
        $imovel = Imovel::find($id);


            if(isset($imovel->media) && !empty($imovel->media) && $imovel->media->count()){

                $medias = $imovel->media;

                foreach ($medias as $m) {
                    
                    if(file_exists(public_path($m->source) ) ){
                        unlink(public_path($m->source)); 
                    }

                    $m->delete();
                    //$m->forceDelete();
                }
            }   


         //$imovel->forceDelete();

        if($imovel != null){    
            $imovel->delete();
        }

        return back()->with('success', 'Anúncio removido com sucesso!');
       
    }


    public function deleteParseXml(Request $request)
    {
        $user = Auth::user()->id;

        (int)$id = $request['id'];

        $xml = Xml::find($id);
        /* Limpa arquivo do servidor */
        $diretorio = public_path('webservice/'.$user.'/xml');
        $file = $diretorio.'/'.$xml->sistema.'.xml';

        if(file_exists($file)){
            unlink($file);
        }

        $xml->delete();

        return back()->with('success', 'Sistema removido com sucesso!');
    }


    public function updateParseXml(Request $request)
    {
        $user = Auth::user()->id;

        (int)$id = $request['id'];

        $xml = Xml::find($id);

        /* Limpa arquivo do servidor */
        $diretorio = public_path('webservice/'.$user.'/xml');
        $file = $diretorio.'/'.$xml->sistema.'.xml';

        if(file_exists($file)){
            unlink($file);
        }

        $arquivo = file_get_contents($xml->url);

        file_put_contents($file, $arquivo);

        $mytime = Carbon::now();

        $xml->LastPublishDate = $mytime->toDateTimeString();

        $xml->save();

        return back()->with('success', 'Lista Atualizada com sucesso! ');
    }


    public function cadastraIntegracao(Request $request)
    {
        $user = Auth::user()->id;
        $xml = Xml::where('anunciante_id', '=', $user)->get();        


       return view('users.anunciantes.anuncios.integrar', compact(['xml'], [$xml]));
    }


    public function leitorXml(Request $request)
    {
        (int)$id = $request['id'];

        $xml = Xml::find($id);

        $user = Auth::user()->id;

        $diretorio = public_path('webservice/'.$user.'/xml');
        
        $file = $diretorio.'/'.$xml->sistema.'.xml';

           
            if ($request->session()->exists('singleObject')) {
                $request->session()->forget('singleObject');
            }


        if(file_exists($file)){           
            
            $data = file_get_contents($file);

            $xmlSis = simplexml_load_string($data, null, LIBXML_NOCDATA);
           
           if($xml->sistema == 'Coruja Sistemas'){

                $obj = json_encode($xmlSis->Listings);

                $header = json_encode($xmlSis->Header);    

                $request->session()->get('anun_integracoes');    
                $request->session()->put('anun_integracoes', $obj); 

                $request->session()->get('header');   
                $request->session()->put('header', $header); 

                $request->session()->get('url');   
                $request->session()->put('url', $file); 


           }

           if($xml->sistema == 'inGaia'){

                $obj = json_encode($xmlSis->Imoveis);

                if($request->session()->exists('anun_integracoes')){
                    $request->session()->forget('anun_integracoes');
                }
                $request->session()->get('anun_integracoes_ingaia');    
                $request->session()->put('anun_integracoes_ingaia', $obj);

                $request->session()->get('url');   
                $request->session()->put('url', $file); 
                                            
           } 
           
          
   


            return redirect()->route('anunciante.xml.get');            
           
        }


        return redirect()->back()->with('errors', 'Houve algum problema durante o tratamento dos dados! Contacte o Suporte');
       

    }


    public function leitorGetXml(Request $request)
    {

        if ($request->session()->exists('singleObject')) {
            $request->session()->forget('singleObject');
        }     
        
        if ($request->session()->exists('anun_integracoes')) {

            $anun_integracoes = json_decode($request->session()->get('anun_integracoes'), true);
            $header = json_decode($request->session()->get('header'), true);
            $url = $request->session()->get('url');

                       
            return view('users.anunciantes.anuncios.anunciosIntegracoes', compact(['anun_integracoes', 'header', 'url'], [$anun_integracoes, $header, $url]));                                          

        }

        if ($request->session()->exists('anun_integracoes_ingaia')) {

            $anun_integracoes_ingaia = json_decode($request->session()->get('anun_integracoes_ingaia'), true);
            
            $url = $request->session()->get('url');

                       
            return view('users.anunciantes.anuncios.anunciosIntegracoes', compact(['anun_integracoes_ingaia', 'url'], [$anun_integracoes_ingaia, $url]));                                          

        }



        return redirect()->route('anunciante.integrar.xml')->with('errors', 'Houve algum problema durante o tratamento dos dados! Contacte o Suporte');

    }



    public function parseXml(Request $request)
    {
        $user = Auth::user()->id;
        $itens = Xml::where('anunciante_id', '=', $user)->get();

        
        foreach ($itens as  $xml) {

            if($xml->sistema == $request['sistema']){  
                return back()->with('errors', 'Você já possui uma integração ativa com este sistema');
                break;
            }
            
        }


        $validatedData = $request->validate([
        'sistema' => 'required|string',
        'url' => 'required|string'       
        ]);

        $mytime = Carbon::now();

        /*Criar diretório e arquivo de consulta*/

        $diretorio = public_path('webservice/'.$user.'/xml');

        if (is_dir($diretorio)){

            $arquivo = file_get_contents($request['url']);

            file_put_contents($diretorio.'/'.$request['sistema'].'.xml', $arquivo);            
            
        }else{   

           mkdir($diretorio, 0775, true); 

           $arquivo = file_get_contents($request['url']);

           file_put_contents($diretorio.'/'.$request['sistema'].'.xml', $arquivo);            
        }


        $new_xml = new Xml();
        $new_xml->fill($validatedData);
        $new_xml->anunciante_id = $user;
        $new_xml->LastPublishDate = $mytime->toDateTimeString();

        $new_xml->save();

     
        return back()->with('success', 'Sistema Integrado com sucesso!');

    }


}
