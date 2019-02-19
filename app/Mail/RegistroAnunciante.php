<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Anunciante;

class RegistroAnunciante extends Mailable
{
    use Queueable, SerializesModels;

    protected $anunciante;

    public function __construct(Anunciante $anunciante)
    {
        $this->anunciante = $anunciante;
    }


    public function build()
    {
        

        return $this->view('emails.users.novoAnunciante')->with([            
            'nome' => $this->anunciante->nome,
            'email' => $this->anunciante->email,
            'token' =>$this->anunciante->verifyAnunciante->token,
            'datahora' => now()->setTimezone('America/Sao_Paulo')->format('d-m-Y H:i:s')
        ])->attach(base_path().'/documentos/nova-proposta-corretores-consagre-imoveis.pdf');
    }
}
