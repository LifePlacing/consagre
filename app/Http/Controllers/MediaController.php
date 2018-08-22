<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Imovel;

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
                           
                            foreach ($request->images as $key => $image) 
                            {
                               $name = $image->getClientOriginalName();

                                /* Upload */

                                $image->move(public_path().'/imagens/imoveis', $name);

                                $medias[] = $name;
                                
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
