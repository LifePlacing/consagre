@extends('admin/layouts/default')

    @section('title')
        Consagre Imoveis Admin
    @parent

@stop


@section('content')

<div class="row pt-4">

   <div class="col-sm-12">

       <div class="element-wrapper">
            
            <h6 class="element-header">
                Registros Recentes
            </h6>
            
            <div class="element-content">

                <div class="row">                                

                    <div class=" col-xs-12 col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="#">
                            <div class="value">
                                {{ $imoveis > 0 ? $imoveis : 'Sem imóveis Cadastrados'}}
                            </div>
                            <div class="label">
                              Imóveis Ativos
                            </div>
                        </a>
                    </div>

                    <div class=" col-xs-12 col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="#">
                            <div class="value">
                                {{ $assinaturas > 0 ? $assinaturas : 'Sem Assinaturas'}}
                            </div>
                            <div class="label">
                              Assinaturas Ativas
                            </div>

                        </a>
                    </div>

                    <div class=" col-xs-12 col-sm-4 col-xxxl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="#">
                            <div class="value">
                              {{ $anunciantes }}
                            </div>
                            <div class="label">
                              Anunciantes Online
                            </div>
                            
                        </a>
                    </div>                         
                    
                </div>
                
            </div>
       </div>

   </div> 

</div>

@stop

