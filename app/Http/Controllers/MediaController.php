<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Media;
use App\Imovel;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{

    public function index()
    {
        return view('upload');
    }


    public function upload(Request $request)
    {
        $imovel = $request->session()->get('imovel');

        $imovel->medias = (is_array($imovel->medias) ? count($imovel->medias) : 0);


        if($imovel->medias < 15) 
        {
            $data_atual = explode('/', date('d/m/Y'));

            $url = ('imagens/imoveis/'.$data_atual[2].'/'.$data_atual[1].'/'.$data_atual[0].'/');

                if(!file_exists($url))
                {
                    mkdir(public_path($url), 0755, true);
                }

            foreach ($request->images as $key => $image) 
            {
                $extension = $image->getClientOriginalExtension();

                $name = $image->getClientOriginalName();
                
                $fileName =  explode(".", $name);

                $img = $fileName[0] .'-'. time() . random_int(100, 999) .'.' . $extension;
                                               
                header('Content-Type: image/jpeg');

                list($width, $height) = getimagesize($image);

                /* NOVOS TAMANHOS*/

                $newwidth = 800; 
                $newheight = ( int )(( $newwidth/$width )*$height );

                // CRIANDO O THUMB
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $imagem_original = imageCreateFromAny($image);


                imagecopyresampled($thumb, $imagem_original, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                                          
                /*========= Criando o Path=========*/

                $path = $url.$img;  


                if($imovel->medias > 15) {  
                    abort(403, "Não Autorizado");                         
                    break;
                }else{
                    
                /*======= SALVANDO A IMAGEM TEMPORARIAMENTE ======= */

                    geraImagem($image, $thumb, $url.$img, 9);                   
                    imagedestroy($thumb);                               
                    imagedestroy($imagem_original);
                    $medias[] = $path; 

                }
                
            }

            $imovel->medias = $medias;

            $contador = count($imovel->medias);

            $request->session()->put('imovel', $imovel);

            $notification = array(
            'message' => 'Você carregou com sucesso '.$contador.' imagem', 
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
          
   
    }

}
