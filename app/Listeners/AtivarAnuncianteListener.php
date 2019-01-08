<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\CadastrarSenhaAnunciante;
use App\Mail\SenhaAnunciante;
use Mail;

class AtivarAnuncianteListener
{

    public function __construct()
    {
        //
    }


    public function handle(CadastrarSenhaAnunciante $event)
    {
        Mail::to($event->anunciante)->queue(new SenhaAnunciante($event->anunciante));
    }
}
