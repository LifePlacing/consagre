<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use App\Anunciante;
use App\Mensagem;
use App\Imovel;
use Validator;
use Carbon\Carbon;

class AnunciantesController extends Controller
{
    public function __construct()
    {
    	$this->middleware(['auth:anuncios'])->except(['cadastro', 'verifyUser']);
    }


    public function index()
    {
        $anunciante = Auth::user();

        $expira = 5;

        $imovel = Cache::remember('imoveis', $expira, function(){
            $anunciante = Auth::user();
            return Imovel::where('anunciante_id', '=', $anunciante->id)->withTrashed()->get();
        });


        $simples = $imovel->where('tipo_de_anuncio', '=', 'simples')->count();       

        $super = $imovel->where('tipo_de_anuncio', '=', 'super')->count();      

        $destaque = $imovel->where('tipo_de_anuncio', '=', 'destaque')->count();
               

        $assinatura = $anunciante->assinaturas->last();
       
       
        $pagamento =  $assinatura->payments->last();  


        return view('users.anunciantes.index', compact(['simples', 'super', 'destaque', 'assinatura', 'pagamento'], [$simples, $super, $destaque, $assinatura, $pagamento]));

    }

    public function infoPlano()
    {
        $expira = 5;

        $imovel = Cache::remember('imoveis', $expira, function(){
            $anunciante = Auth::user();
            return Imovel::where('anunciante_id', '=', $anunciante->id)->withTrashed()->get();
        });


        $simples = $imovel->where('tipo_de_anuncio', '=', 'simples')->count();
        $destaque = $imovel->where('tipo_de_anuncio', '=', 'destaque')->count();
        $super = $imovel->where('tipo_de_anuncio', '=', 'super')->count();
        
        return view('users.anunciantes.infoPlano', compact(['simples', 'destaque', 'super'], 
            [$simples, $destaque, $super]));
    }


    public function cadastro($perfil)
    {
    	if ($perfil == 'imobiliaria') {
    		return view('app.cadastros.imobiliaria');
    	}else if($perfil == 'corretor'){
    		return view('app.cadastros.corretor');
    	}else{
    		abort(403, 'Esta página não existe');
    	}
    }


    public function profile()
    {
        return view('users.anunciantes.profile');
    }

    
    public function profileUpdate(Request $request)
    {
        
        $anunciante = Auth::user();

           $val = [
                'phone_fixo' => $request['phone_fixo'],
                'celular' => $request['celular'],
                'sobre' => $request['sobre'],
                'nome' => $request['nome'],
                'site' => $request['site'],
                'creci' => $request['creci']
            ];


           if(empty($anunciante->cpf) || $anunciante->cpf == null )
            {
                $val += ['cpf' => preg_replace( array('/[^\d]+/'), array(''), $request['cpf'])];

                $validator = Validator::make($val, [
                    'phone_fixo' => 'nullable|string|min:11|max:15',
                    'celular' => 'required|string|min:11|max:15',
                    'sobre' => 'string|min:30|max:100',
                    'nome' => 'required|string|min:5|max:50',
                    'site' => 'nullable|string|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                    'cpf' => 'required|string|min:11|max:11|unique:anunciantes',
                    
                ]);


            }else{
                $validator = Validator::make($val, [                
                    'phone_fixo' => 'string|min:11|max:15',
                    'celular' => 'required|string|min:11|max:15',
                    'sobre' => 'string|min:30|max:100',
                    'nome' => 'required|string|min:5|max:50',
                    'site' => 'nullable|string|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', 
                                       
                ]);
            }


            if ($validator->fails()) {


                return back()->withErrors($validator)
                            ->withInput();
            }else{

                $anunciante->fill($val);
                $anunciante->save();               

                return back()->with('success', 'Dados atualizados com sucesso!');

            }            

        
    }


    public function profileAvatar(Request $request)
    {
        $anunciante = Auth::user();

        $slug = explode("@", $anunciante->email);


        $diretorio = Storage::makeDirectory('imagens/users/'.$slug[0].'-'.$slug[1]);

            if($diretorio){
                $url = ('imagens/users/'.$slug[0].'-'.$slug[1]);
            }else{
                Storage::makeDirectory('imagens/users/'.$slug[0].'-'.$slug[1]);
                $url = ('imagens/users/'.$slug[0].'-'.$slug[1]);
            }

            $avatar = $request->foto->getClientOriginalName();

            $valid = [
                'logo' => $request->foto,
            ];

             $validator = Validator::make($valid, [

                'logo' => 'required|mimes:jpg,png,gif,jpeg',

             ]);

               if($validator->fails()) {

                    return back()->withErrors('Erro no formato da imagem');
                            

               }
                
            $path = $request->foto->storeAs(
                $url, $avatar
            ); 

            $anunciante->logo = ('storage/'.$path);
            $anunciante->save();

            
        return back()->with('success', 'Foto atualizada com sucesso');

    }

    public function messageReceive()
    {

        $imoveis = Imovel::where('anunciante_id', '=', Auth::user()->id )->with('mensagens')->get();
     
        $mensagens = [];

        $today = Carbon::now('America/Sao_Paulo');
            
           foreach ($imoveis as $imovel){                   
               foreach ($imovel->mensagens as $msg) {
                  $mensagens = $msg->orderBy('created_at', 'DESC')->paginate(10);
               }
            }


        return view('users.anunciantes.messages', compact(['mensagens', 'today'], [$mensagens, $today]) );
    }

    public function messageInbox($user, $token)
    {
        $mensagem = Mensagem::find($token);

        $now = Carbon::now('America/Sao_Paulo');

        $mensagem->read_at = $now;
        $mensagem->save();


        return view('users.anunciantes.singleMsg', compact(['mensagem'], [$mensagem]));

    }

    public function messageRemove(Request $request)
    {

        $id = $request['id'];

        $mensagem = Mensagem::find($id);

        if($mensagem != null){ 

            $mensagem->delete();

            return response()->json('Mensagem removida com sucesso!');

        }else{

            return response()->json(array(
                    'code'      =>  401,
                    'message'   =>  'erro'
                ), 401);

        }



    }


}
