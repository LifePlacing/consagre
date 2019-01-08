<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CadastrarSenhaAnunciante
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $anunciante;

    public function __construct($anunciante)
    {
        $this->anunciante = $anunciante;
    }

   
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
