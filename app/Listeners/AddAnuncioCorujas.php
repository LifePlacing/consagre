<?php

namespace App\Listeners;

use App\Events\AdicionarAnuncioXml;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;


class AddAnuncioCorujas implements ShouldQueue
{

    public function __construct()
    {
        
    }


    public function handle(AdicionarAnuncioXml $event)
    {
       Queue::later(60, addImovel($event->obj, $event->anunciante_id));
       
    }
}
