<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Para criar pagamentos
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session as PagseguroSession;
use PagSeguro\Domains\Requests\Payment as PagseguroPayment;

//Para Consultar Pagamentos
use PagSeguro\Services\Transactions\Search\Code as PagseguroSearchCode;
use PagSeguro\Services\Transactions\Notification as PagseguroNotification;
use PagSeguro\Helpers\Xhr;
use PagSeguro\Parsers\Transaction\Response as PagseguroResponse;


class PagseguroController extends Controller
{
    
  public function __construct()
  {
      $this->_configs = new Configure();
      $this->_configs->setCharset('UTF-8');
      $this->_configs->setAccountCredentials(env('PAGSEGURO_EMAIL'), env('PAGSEGURO_TOKEN'));
      $this->_configs->setEnvironment(env('PAGSEGURO_AMBIENTE'));
    //pode ser false
      $this->_configs->setLog(true, storage_path('logs/pagseguro_'. date('Ymd') .'.txt'));

  }


  public function getCredenciais()
  {
      return $this->_configs->getAccountCredentials();
  }

  public function criaRequisicao($assinatura_id)
  {

      try {
          $assinatura = Assinatura::findOrFail($assinatura_id);
          $pagamento = new PagseguroPayment();
          $pagamento->setCurrency('BRL');
          //referência interna do pagamento ao sistema
          $pagamento->setReference($assinatura_id);
          //pegar valores do plano selecionado na tela
          $pagamento->addItems()->withParameters(
              $assinatura->id,
              $assinatura->plano->nome, 1,
              $assinatura->plano->valor
          );

          //pegar do usuario logado

          $pagamento->setSender()->setName(Auth::user()->name);
          $pagamento->setSender()->setEmail(Auth::user()->email);

          //pegar cpf ou cnpj do usuario logado

          if(Auth::user()->cliente->cpf_cnpj){
              $pagamento->setSender()->setPhone()->withParameters(
                  Auth::user()->cliente->tipo_cpf_cnpj,
                  Auth::user()->cliente->cpf_cnpj
              );

          }

          //pegar telefone do usuario logado

          if(Auth::user()->cliente->telefone){
              $pagamento->setSender()->setPhone()->withParameters(
                  Auth::user()->cliente->telefone_ddd,
                  Auth::user()->cliente->telefone
              );

          }

          $onlyCheckoutCode = true;
          $result = $pagamento->register($this->getCredenciais(),$onlyCheckoutCode);
          return $result->getCode();

      } catch (Exception $e) {

          die($e->getMessage());

      }

  }

   public function criaPagamento(Request $request)
  {
      try{

          $pagamento = new Pagamento();

          $pagamento->assinatura_id = $request->assinatura_id;

          $pagamento->transacao = $request->code;

          $pagamento->status_codigo = 1;

          $pagamento->status = 'Aguardando Pagamento';

          if($pagamento->save()){
             return true;
          } else {
              throw new Exception("Error ao salvar");
          }

      } catch (Exception $e) {
         logger($e->getMessage());  

      }

  }


}
