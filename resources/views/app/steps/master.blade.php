@section('header_styles')
    @parent
   
@stop
<div class="top-content">
    <div class="container">

        <div class="col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-2 col-lg-12 col-lg-offset-2 formulario">

        <h3>Anunciar meu imóvel</h3>
        <p>Complete ou atualize seus dados</p> 

        	<!-- Passos do Cadastro -->

            @if(Request::segment(1) == 'anunciar')

                <?php $uriPath = Request::segment(2); ?>

           <div class="f1-steps">

                <div class="f1-progress">
                    <div class="f1-progress-line" style="
                    width: {{$valor}}% ;"></div>
                </div>

                    <div class="f1-step {{ ($uriPath == '') ? 'active' : 'activated'}}">
                        <div class="f1-step-icon"><i class="fa fa-home"></i></div>
                        <p>Sobre seu Imóvel</p>
                    </div>

                    <div class="f1-step <?php if($uriPath == 'anunciar-step2'){ echo 'active' ;} elseif ($uriPath == 'finish'){
                        echo 'activated';}else{ echo '' ;}?> ">
                        <div class="f1-step-icon"><i class="fa fa-image"></i></div>
                        <p>Fotos e Detalhes</p>
                    </div>

                    
                    <div class="f1-step {{ ($uriPath == 'finish') ? 'active' : '' }}">
                        <div class="f1-step-icon"><i class="fa fa-money"></i></div>
                                <p>Planos</p>
                            </div>
                    </div>

            @endif
		</div>

	</div><!-- Fim da Container -->  
</div> 

@section('footer_scripts')
@parent


@stop