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


            if($assinatura->status !== 'active' || $pagamento->status == 'paid'){
                
                if(Auth::guard('anuncios')){
                    return redirect('anunciante')
                    ->with('errors', 'Existem pendências em sua Assinatura!');
                }    

                return redirect('usuario/profile/home')
                    ->with('errors', 'Existem pendências em sua Assinatura!');
            }

        return $next($request);
    }
}
