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

                        $url = ('imagens/imoveis/'.$data_atual[2].'/'.$data_atual[1].'/'.$data_atual[0].'/');

                        if(!file_exists($url))
                            {
                                mkdir(public_path($url), 0755, true);
                            }


                        $logo_img = public_path('/imagens/logo.gif'); 
                        $logo = imagecreatefromgif($logo_img); 
                        $logo_size = getimagesize($logo_img);

                        $logo_width = $logo_size[0]; 
                        $logo_height = $logo_size[1]; 


                           
                            foreach ($request->images as $key => $image) 
                            {
                                $img = $image->getClientOriginalName();  
                                $imagem_original = imageCreateFromAny($image);

                                
                            /* ============= FAZENDO O RESIZE DA IMAGEM ============ */

                                // Content type
                               header('Content-Type: image/jpeg');

                                list($width, $height) = getimagesize($image);

                                /* NOVOS TAMANHOS*/

                                $newwidth = 800; 
                                $newheight = ( int )(( $newwidth/$width )*$height );

                                // CRIANDO O THUMB
                                $thumb = imagecreatetruecolor($newwidth, $newheight);


                                imagecopyresampled($thumb, $imagem_original, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                                /*======= SALVANDO A IMAGEM TEMPORARIAMENTE ======= */

                                geraImagem($image, $thumb, $url.$img, 100);

                                $img_croped = ($url.$img);

                                $imagem_logo = imageCreateFromAny($img_croped);

                                $padding = 20; 
                                $opacidade = 80;            

                                $dest_x = $newwidth - $logo_width - $padding;
                                $dest_y = $newheight - $logo_height - $padding;

                                imagecopymerge($imagem_logo, $logo, $dest_x, $dest_y, 0, 0, $logo_width, $logo_height, $opacidade);


                                geraImagem($img_croped, $imagem_logo, $url.$img, 100); 

                                imagedestroy($imagem_logo);                               
                                imagedestroy($thumb);                               
                                imagedestroy($imagem_original);                               

                              //unlink(public_path('tmp/'.$img));
                               
                            /*========= Criando o Path=========*/

                                $path = $url.$img;                                 
                            
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
