<?php 

use App\Imovel;
use App\Anunciante;
use App\Cidade;
use App\Media;
use App\ImovelType;
use Illuminate\Support\Facades\Storage;


function addImovel($obj, $anunciante_id){

	$imovel = new Imovel();

	//$obj = simplexml_load_string($objeto->asXML(), null, LIBXML_NOCDATA);

	$imovel->codigo = (string)$obj->ListingID;
    $imovel->anunciante_id = $anunciante_id;
    $imovel->titulo = (string)$obj->Title;
    $imovel->meta = config('enums.'.$obj->TransactionType) ? config('enums.'.$obj->TransactionType) : (string)'venda';
    $imovel->descricao = (string)$obj->Details->Description;


    switch ($obj->TransactionType) {

            case 'For Rent':

               if($obj->Details->RentalPrice->attributes()->period == 'Monthly'){

                    $mensal = str_replace(',','.',str_replace('.','',$obj->Details->RentalPrice));
                    
                    $m_preco = number_format( $mensal, 2, '.', '' );
                        
                        /* Valor do mês */          
                        $imovel->preco = floatval($m_preco);

                    $t_preco = ($m_preco * 12);

                        /* Valor do ano */

                        $imovel->preco_venda = floatval($t_preco);

                    break;
                    

                }elseif($obj->Details->RentalPrice->attributes()->period  == 'Quarterly'){

                    $mensal = str_replace(',','.',str_replace('.','',($m_price / 3)));

                    $m_preco = number_format( $mensal, 2, '.', '' );

                        /* Valor do mês */          
                        $imovel->preco = floatval($m_preco);

                        $t_preco = ($m_preco * 12);

                        /* Valor do ano */

                        $imovel->preco_venda = floatval($t_preco);

                    break;

                }elseif ($obj->Details->RentalPrice->attributes()->period  == 'Yearly'){

                    $mensal = str_replace(',','.',str_replace('.','',($m_price / 12)));

                    $m_preco = number_format( $mensal, 2, '.', '' );

                        /* Valor do mês */          
                        $imovel->preco = floatval($m_preco);

                    $t_preco = ($m_preco * 12);

                        /* Valor do ano */

                        $imovel->preco_venda = floatval($t_preco);

                       break;
                }else{

                    $mensal = str_replace(',','.',str_replace('.','',$obj->Details->RentalPrice));
                    
                    $m_preco = number_format( $mensal, 2, '.', '' );
                        
                        /* Valor do mês */          
                        $imovel->preco = floatval($m_preco);

                    $t_preco = ($m_preco * 12);

                        /* Valor do ano */

                        $imovel->preco_venda = floatval($t_preco);

                    break;

                } 
            
            break;


            case 'Sale/Rent':

                $mensal = str_replace(',','.',str_replace('.','', $obj->Details->RentalPrice));
                
                    $m_preco = number_format( $mensal, 2, '.', '' );
                    
                /* Valor do aluguel */          
                $imovel->preco = floatval($m_preco); 

                    $total = str_replace(',','.',str_replace('.','',$obj->Details->ListPrice));

                    $t_preco = number_format( $total, 2, '.', '' );

                /* Valor de venda */

                $imovel->preco_venda = floatval($t_preco);  

            break;

            default :

                   $total = str_replace(',','.',str_replace('.','',$obj->Details->ListPrice));                
                    $t_preco = number_format( $total, 2, '.', '' );
                                  
                    $imovel->preco = floatval($t_preco); 
                    $imovel->preco_venda = floatval($t_preco);
                break;                    
    }


    /*Endereço do Imovel*/

    $city = consultaCidade($obj->Location->City);


        if (empty($city) || $city == null){
            
            /* ============= Criando slug da cidade ==============*/

            $cidade  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $obj->Location->City));

            $slugCidade =  strtolower($cidade);       

            $slug =  str_replace(' ', '_', $slugCidade); 

            $nomeCidade = (string)ucwords(mb_strtolower($obj->Location->City));

            $cidadeImovel = Cidade::create([
                'nome' => $nomeCidade,
                'slug' => $slug
            ]);

        }else{                
            $cidadeImovel = $city;
        }


        $imovel->cidade_id = $cidadeImovel->id;
        $imovel->estado = (string)$obj->Location->State->attributes()->abbreviation;
        $imovel->logradouro = (string)ucwords(mb_strtolower($obj->Location->Address));
        $imovel->bairro = (string)ucwords(mb_strtolower($obj->Location->Neighborhood));
        $imovel->unidade = (string)$obj->Location->StreetNumber;
        $imovel->cep = (string)$obj->Location->PostalCode;
        $imovel->categoria_id = 1;
        $imovel->quartos = intval($obj->Details->Bedrooms);
        $imovel->banheiros = intval($obj->Details->Bathrooms);
        $imovel->suites = intval($obj->Details->Suites);
        $imovel->area_total = floatval($obj->Details->ConstructedArea);
        $imovel->area_util = floatval($obj->Details->LivingArea);
        $imovel->garagem = intval($obj->Details->Garage);

        if($obj->Details->PropertyAdministrationFee > 0)
        {
            $imovel->condominio = floatval($obj->Details->PropertyAdministrationFee);
        }

        if($obj->Details->YearlyTax > 0)
        {
           $imovel->iptu = floatval($obj->Details->YearlyTax);
        }

        $tipo = __('imovels.'.$obj->Details->PropertyType);

        $imovelType = consultaTipoImovel($tipo);


       if($imovelType != null)
       {
            $imovel->imovel_type_id = $imovelType->id;

       }else{
            $imovel->imovel_type_id = 1;
       }

	    if($obj->Featured == "true")
	    {
	        $imovel->tipo_de_anuncio = 'destaque';
	    }

        $imovel->status = 1;

        $imovel->save();

        /*Adicionando Medias*/

        adicionarMedia($obj->Media->Item, $imovel->id);

}


function consultaCidade($cidade)
{
	$city = Cidade::where('nome','=', $cidade)->first();

	return $city;
}


function consultaTipoImovel($imovelTipo)
{
	$imovelType = ImovelType::where('tipo', '=', $imovelTipo)->first();

	return $imovelType;
}


function adicionarMedia($itens, $imovel_id)
{

        $i = 0;

        foreach ($itens as $key => $item) {

            $count = $i++;

            $media = new Media();
            $media->imovel_id = $imovel_id;                

            $urlArquivo  = (string)$item; 

            $novaUrl = preg_replace("/^http:/i", "https:", $urlArquivo);
            
            $media->source = $novaUrl;

            if($item->attributes()->primary){
                $media->position = 0;
            }

            if($count != 0){
                $media->position =  $count ;                                      
            }            

            $media->caption = $item->attributes()->caption; 
            
            $media->save(); 

        }

}