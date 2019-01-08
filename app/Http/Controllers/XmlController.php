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


		foreach ($xml->Listings->Listing as $item) {
			
			$ListingID = $request['ListingID'];

			$registro = simplexml_load_string($item->asXML(), null, LIBXML_NOCDATA);

			if ($registro->ListingID == $ListingID) {
				
				$request->sesion()->put('imovelDetalhes', $registro);

				return redirect()->route('anunciante.detalhes.single');

			}


		}
    }


    public function singleDetalhesXml(Request $request)
    {

    	if($request->session()->exists('imovelDetalhes')){

    		$imovel = $request->session()->get('imovelDetalhes');

    		return view('users.anunciantes.anuncios.detalheSingleIntegracoes');
    	}

    	return back()->with('errors', 'Ocorreu um erro para mais detalhes contacte o suporte');

    }


}
