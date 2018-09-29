<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Imovel;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function upload(Request $request)
    {
        $imovel = $request->session()->get('imovel');

        $medias = array();

            if(!isset ($imovel->medias)) 
            {              

                if(count($request->images) < 5)
                    {

                       $data_atual = explode('/', date('d/m/Y'));
                           
                            foreach ($request->images as $key => $image) 
                            {
                                $imagem = $image->getClientOriginalName();                                

                                $path = $image->storeAs('imagens/imoveis/'.$data_atual[2].'/'.$data_atual[1].'/'.$data_atual[0], $imagem);                                
                               
                                $medias[] = $path;
                                
                            }

                        $imovel->medias = $medias;

                        $request->session()->put('imovel', $imovel);
                        

                        $notification = array(
                        'message' => 'Você carregou com sucesso uma imagem', 
                        'alert-type' => 'success'
                        );   

                        return response()->json([$notification], 200);                         

                    }else{

                        $notification = array(
                        'errors' => 'Não Autorizado', 
                        'alert-type' => 'errors'
                        ); 
                        abort(403, "Não Autorizado");
                        
                        return response()->json([$notification], 403);

                    }

            }else{

                $notification = array(
                'errors' => 'Não Autorizado', 
                'alert-type' => 'errors'
                ); 
                abort(403, "Não Autorizado");
                        
                return response()->json([$notification], 403);

            }
            
   
    }

}
