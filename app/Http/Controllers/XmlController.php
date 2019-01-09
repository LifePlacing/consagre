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

class XmlController extends Controller
{
     public function __construct()
    {
         $this->middleware(['auth:anuncios', 'check.assinatura']);         
    }



    public function singleXml(Request $request)
    {
    	

    	$url_arquivo_xml = $request['url'];

		$xml = simplexml_load_file($url_arquivo_xml);

        $request->session()->get('singleObject');

		foreach ($xml->Listings->Listing as $item) {
			
			$ListingID = $request['ListingID'];

			$registro = simplexml_load_string($item->asXML(), null, LIBXML_NOCDATA);

			if ($registro->ListingID == $ListingID) {  

                $obj = json_encode($registro); 

                $request->session()->put('singleObject', $obj);                                

                return redirect()->route('xml.detalhesdoimovel');
               
			}


		}
    }

    public function singleDetalhesXml(Request $request)
    {
     
        $registro = json_decode($request->session()->get('singleObject'));

        
        return view('users.anunciantes.anuncios.detalheSingleIntegracoes', compact('registro', $registro));
    }


}
