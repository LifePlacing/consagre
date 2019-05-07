<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{

    protected $except = [
       'https://viacep.com.br/ws*',
       '*viacep.com.br/ws*'
    ];
}
