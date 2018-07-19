<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{

    protected $dontReport = [
        //
    ];


    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception){

        $guard = array_get($exception->guards(), 0);
              
        switch ($guard) {
            case 'admin':
            return redirect()->guest(route("admin.login"));
                break;            
            default:                    
            return redirect()->guest(route("login"));
                break;
        }

        return redirect()->guest(route("login"));

    }


}
