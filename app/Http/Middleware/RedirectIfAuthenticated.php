<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    } 

    public function handle($request, Closure $next, $guard = null)
    {


        if (Auth::guard($guard)->check()) {
            

            if($guard == 'anuncios'){

                return redirect()->route('anunciante.dashboard');

            }

            if($guard == 'web'){

                if ($this->auth->check()) { 
                    
                    if ($this->auth->user()->role == 'admin') {
                        
                        return redirect()->route('admin.dashboard');
                       
                    }
                    if ($this->auth->user()->role == 'membro') {
                        
                        return redirect()->intended('/');
                    }

                }

             



            }

        }

        return $next($request);
        
    }

}
