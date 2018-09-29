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


function imageCreateFromAny($filepath) {
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


