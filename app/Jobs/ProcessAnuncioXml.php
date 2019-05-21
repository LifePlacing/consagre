<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessAnuncioXml implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $obj;
    protected $anunciante_id;

    public function __construct($obj, $anunciante_id)
    {
        $this->obj =  $obj;
        $this->anunciante_id = $anunciante_id;
    }

    public function handle()
    {
        $obj = simplexml_load_string($this->obj, null, LIBXML_NOCDATA);
        addImovel($obj, $this->anunciante_id);
    }
}
