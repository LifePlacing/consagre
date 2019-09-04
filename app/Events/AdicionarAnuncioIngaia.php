<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdicionarAnuncioIngaia
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $obj;
    public $anunciante_id;

    public function __construct($obj, $anunciante_id)
    {
        $this->obj = $obj;
        $this->anunciante_id = $anunciante_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
