<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{

    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }    

    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {            
            
            if ($this->auth->user()->role == 'admin') {
                
                return redirect()->route('admin.dashboard');
               
            }
            if ($this->auth->user()->role == 'membro') {
                
                return redirect()->intended('/');
            }
        }

        return $next($request);
        
    }

}
