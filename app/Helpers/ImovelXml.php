<?php 

use App\Imovel;
use App\Anunciante;
use App\Cidade;
use App\Media;
use App\ImovelType;
use App\Categoria;
use Illuminate\Support\Facades\Storage;


function addIngaia($obj, $anunciante_id){

           
            $city = consultaCidade((string)$obj->Cidade);

            $cidadeImovel = '';

            if($city == null || empty($city)){                

                /* ============= Criando slug da cidade ==============*/

                $cidade  = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', (string)$obj->Cidade));

                $slugCidade =  strtolower($cidade);       

                $slug =  str_replace(' ', '_', $slugCidade); 

                $cidadeImovel = Cidade::create([
                    'nome' => (string)$obj->Cidade,
                    'slug' => $slug
                ]);


            }else{
                $cidadeImovel = $city;
            }

            /*Categoria*/

            $cat = Categoria::where('name', '=', $obj->CategoriaImovel)->first();

            $categoria = '';
            
            if($cat == null || empty($cat)){
                
                $categoria = Categoria::create([
                    'name' => (string)$obj->CategoriaImovel,
                ]);

            }else{
                $categoria = $cat;
            }


            /*Tipo de imovel*/

            $tipo = ImovelType::where('tipo', '=', (string)$obj->TipoImovel)->first();

            $imovelType = '';

               if($tipo == null || empty($tipo))
               {
                   $imovelType = ImovelType::create([
                        'tipo' => (string)$obj->TipoImovel,
                   ]);
               }else{
                  $imovelType = $tipo;
               }

            $imovel = new Imovel();
            $imovel->codigo = (string)$obj->CodigoImovel;
            $imovel->status = 1;
            $imovel->anunciante_id = $anunciante_id;
            $imovel->titulo = (string)$obj->TituloImovel;
            $imovel->suites = isset($obj->QtdSuites) ? (int)$obj->QtdSuites : 0;
            $imovel->banheiros = isset($obj->QtdBanheiros) ? (int)$obj->QtdBanheiros : 0;
            $imovel->quartos = isset($obj->QtdDormitorios) ? (int)$obj->QtdDormitorios : 0;
            $imovel->garagem = isset($obj->QtdVagas) ? (int)$obj->QtdVagas : 0;
            $imovel->cidade_id = $cidadeImovel->id;
            $imovel->categoria_id = $categoria->id;
            $imovel->imovel_type_id = $imovelType->id;
            $imovel->estado = (string)$obj->Estado;
            $imovel->bairro = (string)$obj->Bairro;

            if(isset($obj->Endereco) && !empty($obj->Endereco)){
                $imovel->logradouro = (string)$obj->Endereco;
            }else{
                $imovel->logradouro = "Não Informado";
            }

            if(isset($obj->CEP) && !empty($obj->CEP)){
                $imovel->cep = (string)$obj->CEP;
            }else{
                $imovel->cep = "00000000";
            }

            if(isset($obj->Numero)){
                $imovel->unidade = (string)$obj->Numero;
            }else{
                $imovel->unidade = "0";
            }


            if(isset($obj->PrecoIptu) && !empty($obj->PrecoIptu)){
                $imovel->iptu = floatval($obj->PrecoIptu);
            }

            if (isset($obj->PrecoCondominio) && !empty($obj->PrecoCondominio)) {
                $imovel->condominio = floatval($obj->PrecoCondominio);
            }

            if(isset($obj->TipoOferta) && $obj->TipoOferta == '3'){
                $imovel->tipo_de_anuncio = 'super' ;
            }elseif(isset($obj->TipoOferta) && $obj->TipoOferta == '2'){
                $imovel->tipo_de_anuncio = 'destaque' ;
            }else{
                $imovel->tipo_de_anuncio = 'simples' ;
            }




            /*Verificando Meta do anuncio*/

            if(isset($obj->PrecoVenda) && isset($obj->PrecoLocacao)){

                $imovel->meta = 'Venda/Aluguel';
                $imovel->preco_venda = floatval($obj->PrecoVenda);
                $imovel->preco = floatval($obj->PrecoLocacao);

                if(isset($obj->PublicaValores)){
                   $imovel->publica_valores = (string)$obj->PublicaValores;
                }

                if( isset($obj->TipoLocacao) && $obj->TipoLocacao == '3'){
                    /*Locação Mensal*/
                    $imovel->periodo_aluguel = "Mensal";

                }elseif(isset($obj->TipoLocacao) && $obj->TipoLocacao == '4'){
                    
                    /*Locação anual*/
                     $imovel->periodo_aluguel = "Anual";
                }

            }elseif(isset($obj->PrecoVenda) && isset($obj->PrecoLocacaoTemporada)){

                $imovel->meta = 'Temporada';
                $imovel->preco_aluguel = floatval($obj->PrecoLocacaoTemporada);
                $imovel->preco_venda = floatval($obj->PrecoVenda);

                    if(isset($obj->PublicaValores)){
                       $imovel->publica_valores = (string)$obj->PublicaValores;
                    }

                    if( isset($obj->TipoLocacao) && $obj->TipoLocacao == '2'){
                        /*Locação Mensal*/
                        $imovel->periodo_aluguel = "Diária";

                    }else{                        
                        /*Locação anual*/
                         $imovel->periodo_aluguel = "Não informado";
                    }


            }elseif(isset($obj->PrecoVenda)){

                $imovel->meta = 'venda';
                $imovel->preco_venda = floatval($obj->PrecoVenda);
                $imovel->preco = floatval($obj->PrecoVenda);

                if(isset($obj->PublicaValores)){
                   $imovel->publica_valores = (string)$obj->PublicaValores;
                }

            }else{
                $imovel->meta = 'aluguel';
                $imovel->preco_venda = floatval($obj->PrecoLocacao);
                $imovel->preco = floatval($obj->PrecoLocacao);

                if(isset($obj->PublicaValores)){
                   $imovel->publica_valores = (string)$obj->PublicaValores;
                }

            }

            $complemento = isset($obj->ComplementoEndereco) ? $obj->ComplementoEndereco : 'Sem referencias';

            $condominio = isset($obj->NomeCondominio) ? 'Condomínio '.$obj->NomeCondominio : '';

            /* Caracteristicas Principais */

            $frenteMar = isset($obj->FrenteMar) && $obj->FrenteMar == 1 ? ' Frente Mar ' : '';
            $beiraMar = isset($obj->BeiraMar) && $obj->BeiraMar == 1 ? ' Pé na Areia ' : '';

            $varandaGourmet = isset($obj->VarandaGourmet) && $obj->VarandaGourmet == 1 ? ' Varanda Gourmet ' : '';
            $sacada = isset($obj->Sacada) && $obj->Sacada == 1 ? ' Sacada ' : '';

            $lavabo = isset($obj->Lavabo) && $obj->Lavabo == 1 ? ' Lavabo ' : '';

            $porcelanato = isset($obj->PisoPorcelanato) && $obj->PisoPorcelanato == 1 ? ' Porcelanato ' : '';

            $churrasqueira = isset($obj->Churrasqueira) && $obj->Churrasqueira == 1 ? ' Churrasqueira ' : '';  
            

            
            $descricao = $obj->TipoImovel.' '.$obj->Finalidade.' em '. $obj->Cidade.'/'.$obj->Estado.' no Bairro '.$obj->Bairro.' '.$complemento.' '.$condominio.' com '.$obj->AreaUtil.' m2. Características: '. $frenteMar .$beiraMar . $varandaGourmet .  $sacada . $lavabo . $porcelanato . $churrasqueira;
            
            $imovel->descricao = (string)$descricao;

            if(isset($obj->AreaUtil)){
                $imovel->area_util = floatval($obj->AreaUtil);
                $imovel->area_total = floatval($obj->AreaTotal);
            }

           $imovel->save();


            /*Adicionando Medias*/
            if(isset($obj->Fotos)){ 
               if(count($obj->Fotos->Foto) > 1){
                    adicionarMedia($obj->Fotos->Foto, $imovel->id);
                }else{
                    adicionarMedia($obj->Fotos, $imovel->id);
                }
            }


}

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

function lerXml($url){
    
    $xml = simplexml_load_file($url, "SimpleXMLElement",LIBXML_NOCDATA);

    return $xml;
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

            if((string)$item->URLArquivo){
                $urlArquivo  = (string)$item->URLArquivo; 
            }else{
               $urlArquivo  = (string)$item;   
            }
           

            $novaUrl = preg_replace("/^http:/i", "https:", $urlArquivo);

            if(url_exists($novaUrl)){
                $media->source = $novaUrl;
            }else{
                $media->source = url('imagens/consagre-imoveis-sem-imagem.png');
            }

            
            
            

            if($item->attributes()->primary || isset($item->Principal)){
                $media->position = 0;
            }

            if($count != 0){
                $media->position =  $count ;                                      
            }            

            if(isset($item->FotoDescricao)){
                $media->caption = $item->FotoDescricao;   
            }elseif(isset($item->attributes()->caption)){
                $media->caption = $item->attributes()->caption; 
            }else{
                $media->caption = '';
            }
            
            
            $media->save(); 

        }

}