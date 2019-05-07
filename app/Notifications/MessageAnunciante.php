<?php

namespace App\Notifications;

use App\Mensagem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MessageAnunciante extends Notification
{
    use Queueable;

    private $mensagem;


    public function __construct( Mensagem $mensagem)
    {
       $this->mensagem = $mensagem;
    }

    
    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {

        $titulo = $this->mensagem->imovel->titulo;     
        $remetente =  $this->mensagem->nome_remetente;  

        return (new MailMessage)
                    ->subject("Você uma nova Mensagem!" )
                    ->greeting('Olá!')
                    ->line("$remetente demonstrou interesse em um dos seus anúncios")
                    ->action('Entre em contato agora', url('/'))
                    ->line('Confira as informações no seu painel');
    }

    
    public function toArray($notifiable)
    {
        return [
           
        ];
    }
}
