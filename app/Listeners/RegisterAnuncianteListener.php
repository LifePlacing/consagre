<?php

namespace App\Listeners;

use App\Events\NovoAnunciante;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\RegistroAnunciante;
use Mail;

class RegisterAnuncianteListener
{

    public function __construct()
    {
        //
    }


    public function handle(NovoAnunciante $event)
    {
        info("Novo Anunciante Cadastrado!");
        info($event->anunciante->nome);
        Mail::to($event->anunciante)->queue(new RegistroAnunciante($event->anunciante));
    }
}
