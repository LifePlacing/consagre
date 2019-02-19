<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class CheckAssinatura
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    } 


    public function handle($request, Closure $next)
    {

        /* Verifica se Assinatura está como paga */

            $anunciante = Auth::user();


        /*Assinatura*/

            $assinatura = $anunciante->assinaturas->last();

        /*Pagamento*/
            $pagamento = $assinatura->payments->last();

        /*Plano*/    
            $plano = $anunciante->plano;

            if($assinatura->status !== 'active' || $pagamento->status !== 'paid'){
                
                if(Auth::guard('anuncios')){
                    return redirect('anunciante')
                    ->with('errors', 'Existem pendências em sua Assinatura!');
                }    

                return redirect('usuario/profile/home')
                    ->with('errors', 'Existem pendências em sua Assinatura!');
            }

            $status = checkAnuncios($anunciante, $plano);

           
            if(!$status){
                
                if(Auth::guard('anuncios')){
                    return redirect('anunciante')
                    ->with('errors', 'Seu plano já esgotou os limites de anuncio. Contrate um novo plano!');
                }    

                return redirect('usuario/profile/home')
                    ->with('errors', 'Seu plano já esgotou os limites de anuncio. Contrate um novo plano!');          
                
            }
           
        return $next($request);
    }
}
