<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role
{


    protected $auth;


    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    
    public function handle($request, Closure $next)
    {


        if (!$this->auth->check() or $this->auth->user()->role !== 'admin') {

            if ($request->ajax()) {
                return array('errors', 'Você não é Administrador..');
            } else {

                $notification = array(
                'message' => 'Você não tem permissão! Seu lugar é aqui...', 
                'alert-type' => 'warning'
                );
                \Session::flash('error.message',  'Você não tem permissão!');
                return redirect()->route('home')->with($notification);
            }
        }

        return $next($request);

    }
}
