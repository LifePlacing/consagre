<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\ResetPassword as Mailable;

class ResetPassword extends Notification
{
    use Queueable;

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {

        $subject = sprintf("[%s] %s", config('app.name'), "Redefinir Senha");

        return (new Mailable($this->token, $notifiable))->subject($subject)->to($notifiable->email);

    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
