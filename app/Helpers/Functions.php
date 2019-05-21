<?php

use App\Imovel;
use App\Gateway;
use Illuminate\Support\Facades\Cache;


function file_get_contents_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_URL, $url);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}



function formatCodigo($value)
{
	if ($value == null || empty($value)) {
		
		$codigo = 'Codigo Nulo';
	}else{
	$string = explode(':', $value);
	$codigo = $string[0];
	}

    return $codigo;
}

function consultaCredenciais($nome)
{
	$gateway = Gateway::where('nome', '=', $nome)->first();

		if(!empty($gateway) && $gateway->nome == 'Gerencia Net'){

			return [ 'client_id' => $gateway->cliente_id,
		  	'client_secret' => $gateway->cliente_secret,
		  	'sandbox' => $gateway->cliente_sandbox,
			];

		}

	return [
		'client_id' => config('app.client_id_gerencianet'),
		'client_secret' => config('app.client_secret_id_gerencianet'),
		'client_sandbox' => config('app.sandbox_gerencianet'),
	];

}


function date_br($value, $format='d/m/Y')
{
   return date($format, strtotime($value));
}


function formataMoedaInteiro($valor){


	$valor_moeda = $valor / 100;

	$currency = number_format($valor_moeda, 2, ',', '.');

	return "R$ ".$currency;

}



function soNumero($str) {
	$number = trim($str);
    return preg_replace("/[^0-9]/", "", $number);
}


function formataMoney($valor)
{
	if($valor == null || empty($valor)){

		return " <h5>Sob Consulta</h5> ";

	}else{

		$currency = number_format($valor, 2, ',', '.');
		
		return "R$ ".$currency;
	}
}


function slugTitulo($valor)
{
	$titulo  = preg_replace( '/[`^~\'".,]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $valor));
	$titulo = preg_replace('![ç]+!u','c',$titulo);
	$titulo= preg_replace('![ñ]+!u','n',$titulo);
	$titulo = preg_replace('[^a-z0-9\-]','',$titulo);
	
	$slug =  str_replace(' ', '-', $titulo);
	$slug = str_replace('--','-',$slug);
	$slug = str_replace('/','-',$slug);
	$slugTitulo =  strtolower($slug);

	return $slugTitulo;
}

function verificaMensagens($user_id)
{

        $imoveis = Imovel::where('anunciante_id', '=', $user_id)->with('mensagens')->get();
     
        $mensagens = 0;        
            
       foreach ($imoveis as $imovel){                   
           foreach ($imovel->mensagens as $msg) {
                      		
           		if( $msg->read_at == '' || $msg->read_at == null ){
              		$mensagens += 1;
           		}

           }
        }

        return $mensagens;

}


function geraImagem($filepath, $file, $url, $qualidade){

$type = exif_imagetype($filepath); 

	$allowedTypes = array(
	1 , // [] gif
	2 , // [] jpg
	3 , // [] png
	6 // [] bmp
	);

	if (!in_array($type , $allowedTypes)){

	    $notification = array(
	    'errors' => 'Não Autorizado', 
	    'alert-type' => 'errors'
	    ); 
	    abort(403, "Não Autorizado");

	    return response()->json([$notification], 403);
	}

	switch ($type) {
	case 1 :
	$image = imagegif($file, $url);;
	break;
	case 2 :
	$image = imagejpeg($file, $url, $qualidade);
	break;
	case 3 :
	$image = imagepng($file, $url);
	break;
	case 6 :
	$image = imagebmp($file, $url);
	break;
	}

	return $image ;

}


function imageCreateFromAny($filepath){

$type = exif_imagetype($filepath); 

	$allowedTypes = array(
	1 , // [] gif
	2 , // [] jpg
	3 , // [] png
	6 // [] bmp
	);

	if (!in_array($type , $allowedTypes)){

	    $notification = array(
	    'errors' => 'Não Autorizado', 
	    'alert-type' => 'errors'
	    ); 
	    abort(403, "Não Autorizado");

	    return response()->json([$notification], 403);
	}
	switch ($type) {
	case 1 :
	$im = imageCreateFromGif($filepath);
	break;
	case 2 :
	$im = imageCreateFromJpeg($filepath);
	break;
	case 3 :
	$im = imageCreateFromPng($filepath);
	break;
	case 6 :
	$im = imageCreateFromBmp($filepath);
	break;
	}
return $im ;
}


function formataPhone($numero)
{

			if (isset($numero) && !empty($numero)) {

				$numero = preg_replace("[^0-9]", "", $numero);

				$size = strlen($numero);

			if($size === 10){

             $numero = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 4) 
             . '-' . substr($numero, 6);
         	}else if($size === 11){

             			$numero = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 5) 
         				. '-' . substr($numero, 7);
         	}

        return $numero;
		
		}


}

function calculaPorcentagem($valor, $porcentagem)
{
	$resultado = $valor * ($porcentagem / 100);

	return $resultado;
}


function escondeEmail($email)
{

	$mail = explode('@', $email);
	$qtd_char = strlen($mail[0]);
	$inicio = substr($mail[0],0, 8);
	$email_editado = str_pad($inicio, $qtd_char, "*");

	$string = $email_editado.'@'.$mail[1];

	return $string;
}


function abrevia($string)
{
	$inicio = substr($string,0, 50);	

	return $inicio;
}

function abreviaCod($string)
{
	$inicio = substr($string,0, 15);	

	return $inicio;
}


function contaAnuncios($user, $request)
{
	$imovel = Imovel::where('anunciante_id', '=', $user->id)->withTrashed()->get();

	$plano = $user->plano;

	    $simples = $imovel->where('tipo_de_anuncio', '=', 'simples')->count(); 



        $super = $imovel->where('tipo_de_anuncio', '=', 'super')->count();



        $destaque = $imovel->where('tipo_de_anuncio', '=', 'destaque')->count();


	        /* Contador */

	        $super_count = $plano->super_destaques - $super;
	        $dest_count = $plano->destaques - $destaque;

        if($plano->quant_anuncios > 0){

			$s_count = $plano->quant_anuncios - $simples;

			if($request == 'simples' && $s_count == 0){
    			return false;
    		}
    	}


	    if($request == 'super' && $super_count == 0){
	    	return false;
	    }

	    if($request == 'destaque' && $dest_count == 0){
	    	return false;
	    }

	return true;

}

function checkAnuncios($user, $plano)
{

        $imovel = Imovel::where('anunciante_id', '=', $user->id)->withTrashed()->get();
      

        $simples = $imovel->where('tipo_de_anuncio', '=', 'simples')->count();       

        $super = $imovel->where('tipo_de_anuncio', '=', 'super')->count();      

        $destaque = $imovel->where('tipo_de_anuncio', '=', 'destaque')->count();

	       if($plano->quant_anuncios > 0){
	        
	        	if( $simples >= $plano->quant_anuncios && $super >= $plano->super_destaques && $destaque >= $plano->destaques){

	        		return false;
	        	}

	       }else{
	       	        if($super >= $plano->super_destaques && $destaque >= $plano->destaques){

	        			return false;
	        		}
	       }


         return true;

}




function verificaStatus($status)
{
	switch ($status) {
		case 'new':
			$st = 'novo';
			break;
		case 'active':
			$st = 'ativo';
			break;
		case 'waiting':
			$st = 'Aguardando Pagamento';
			break;
		case 'paid':
			$st = 'Pagamento Confirmado';
			break;
		case 'unpaid':
			$st = 'Problemas no Pagamento';
			break;
		case 'refunded':
			$st = 'Pagamento Devolvido';
			break;
		case  'contested':
			$st = 'Pagamento em Contestação';
			break;
		case 'canceled':
			$st = 'Cancelado';
			break;
		case 'settled':
			$st = 'Pagamento Confirmado (via Admin)';
			break;
		case 'expired':
			$st = 'Link de Pagamento expirado!';
			break;		
		default:
			$st = 'Aguardando Pagamento';
			break;
	}


	return $st;
}


