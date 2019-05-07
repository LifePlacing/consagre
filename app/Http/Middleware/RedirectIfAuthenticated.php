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
            if ($guard == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            if($guard == 'web'){
                return redirect()->intended('/');
            } 
        }

        return $next($request);
        
    }

}
