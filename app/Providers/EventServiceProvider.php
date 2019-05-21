<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        'App\Events\NovoAnunciante' => [
            'App\Listeners\RegisterAnuncianteListener',
        ],

        'App\Events\CadastrarSenhaAnunciante' => [
        	'App\Listeners\AtivarAnuncianteListener',
        ],
        'App\Events\AdicionarAnuncioXml' => [
            'App\Listeners\AddAnuncioCorujas',
        ]
    ];


    public function boot()
    {
        parent::boot();

        
    }
}
