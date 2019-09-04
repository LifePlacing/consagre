<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Imovel;
use App\Events\AdicionarAnuncioIngaia;
use Illuminate\Support\Facades\Log;

class ProcessAnuncioXml implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $obj;
    protected $anunciante_id;
    protected $sistema;

    public function __construct($obj, $anunciante_id, $sistema)
    {
        $this->obj =  $obj;
        $this->anunciante_id = $anunciante_id;
        $this->sistema = $sistema;
    }

    public function handle()
    {       

       $obj = simplexml_load_string($this->obj, null, LIBXML_NOCDATA);
            
        if($this->sistema == 'Corujas'){
            addImovel($obj, $this->anunciante_id);
        }else if($this->sistema == 'inGaia'){ 
            addIngaia($obj, $this->anunciante_id);             
        }  
       
    }
}
