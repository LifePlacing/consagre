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
        $codigo = $this->mensagem->imovel->codigo;     
        $remetente =  $this->mensagem->nome_remetente;
        $email_anunciante = $this->mensagem->imovel->anunciante->email; 
        $email_remetente = $this->mensagem->email_remetente;

        return (new MailMessage)
                    ->subject("Você tem uma nova Mensagem!" )                    
                    ->replyTo($email_remetente)
                    ->greeting('Olá!')
                    ->line("$remetente demonstrou interesse em um dos seus anúncios")
                    ->line("Código do Imóvel: $codigo")
                    ->action('Entre em contato agora', url('/'))
                    ->line('Confira as informações no seu painel');
    }

    
    public function toArray($notifiable)
    {
        return [
           
        ];
    }
}
