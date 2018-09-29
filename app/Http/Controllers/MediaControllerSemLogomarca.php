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
                                $img = $image->getClientOriginalName();                               

                                $logo_img = public_path('/imagens/logo.gif'); 
                                $logo = imagecreatefromgif($logo_img); 
                                $logo_size = getimagesize($logo_img);

                                $logo_width = $logo_size[0]; 
                                $logo_height = $logo_size[1]; 

                                $imagem_original = imageCreateFromAny($image);

                                $padding = 20; 
                                $opacidade = 100;            

                                $dest_x = $newwidth - $logo_width - $padding;
                                $dest_y = $newheight - $logo_height - $padding;

                                imagecopymerge($imagem_logo, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height, $opacidade);


                                /*========= Criando a imagem=========*/


                                imagejpeg($imagem_original, 'imagens/imoveis/'.$data_atual[2].'/'.$data_atual[1].'/'.$data_atual[0].'/'.$img);    

                                imagedestroy($imagem_original);                    

                                $path = 'imagens/imoveis/'.$data_atual[2].'/'.$data_atual[1].'/'.$data_atual[0].'/'.$img;                                 
                            
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
