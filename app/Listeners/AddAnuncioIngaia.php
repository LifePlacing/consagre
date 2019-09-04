<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\AdicionarAnuncioIngaia;
use App\Imovel;

class AddAnuncioIngaia
{

    public function __construct()
    {
       
    }

    public $queue = 'inGaia';

    public function handle(AdicionarAnuncioIngaia $event)
    {

    	$imovel = Imovel::where('anunciante_id', '=', $event->anunciante_id)->where('codigo', '=', $event->obj->CodigoImovel )->withTrashed()->first();

        if($imovel == null){
            Queue::later(60, addIngaia($event->obj, $event->anunciante_id));
        }else{
            Log::info('Anuncio já existente '.$event->obj->CodigoImovel);
        }
        
    }
}
