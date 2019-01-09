<?php

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


function date_br($value, $format='d/m/Y')
{
   return date($format, strtotime($value));
}


function formataMoedaInteiro($valor){


	$valor_moeda = $valor / 100;

	$currency = number_format($valor_moeda, 2, ',', '.');

	return "R$ ".$currency;

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
	$titulo  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $valor));
	$slug =  str_replace(' ', '-', $titulo);
	$slugTitulo =  strtolower($slug);

	return $slugTitulo;
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
	$image = imagegif($file, $url, $qualidade);;
	break;
	case 2 :
	$image = imagejpeg($file, $url, $qualidade);
	break;
	case 3 :
	$image = imagepng($file, $url, $qualidade);
	break;
	case 6 :
	$image = imagebmp($file, $url, $qualidade);
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


