@extends('layouts.head')

@section('content')

@if('sandbox' == env('PAGSEGURO_AMBIENTE'))

  <script type="text/javascript"

  src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">

  </script>

@else

  <script type="text/javascript"

      src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">

  </script>

@endif

<script type="text/javascript">

	function criaRequisicao(id){

	      $.get("requisicao/" +  id, function( data ){

	        }).done(function(data){

	            abrePagseguro(data, id)

	        }).fail(function() {

	        }).always(function() {

	        });

	}


	function abrePagseguro(code, id){

	      var isOpenLightbox = PagSeguroLightbox({

	          code: code

	      }, {

	          success : function(transactionCode) {

	              criaPagamento(transactionCode, id);

	          },

	          abort : function() {

	          }

	      });

	      // Redirecionando o cliente caso o navegador não tenha suporte ao Lightbox

	      if (!isOpenLightbox){

	@if('sandbox' == env('PAGSEGURO_AMBIENTE'))

	location.href="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;

	@else

	location.href="https://pagseguro.uol.com.br/v2/checkout/payment.html?code="+code;

	@endif

	      }

	}


	function criaPagamento(code, id){

	      var token = '{{csrf_token()}}';

	      $.post( "pagar",{'code': code, 'assinatura_id' : id , '_token': token }, 

	        function( data ) {

	        }).done(function(data) {

	          location.reload();

	        }).fail(function() {

	        }).always(function() {

	        });

	}

</script>

@endsection