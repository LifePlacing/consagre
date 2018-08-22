@extends('layouts/admin')

{{-- Page title --}}
@section('title')
    Dashboard
    @parent
@stop
{{-- page level styles --}}


@section('header_styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/c3/css/c3.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/toastr/css/toastr.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/switchery/css/switchery.min.css')}}" />
    <!--page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/new_dashboard.css')}}"/>
    <!-- end of page level styles -->
@stop


{{-- Page content --}}
@section('content')

<header class="head">
    <div class="main-bar">
        <div class="row">
            <div class="col-6">
                <h4 class="m-t-5">
                    <i class="fa fa-home"></i>
                    Painel de Controle 
                </h4>
            </div>
        </div>
    </div>
</header>
<div class="outer">
    <div class="inner bg-container">
        <div class="row">
            <div class="col-xl-6 col-lg-7 col-12">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="bg-primary top_cards">
                            <div class="row icon_margin_left">

                                <div class="col-lg-5 col-5 icon_padd_left">
                                    <div class="float-left">
                                        <span class="fa-stack fa-sm">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-user fa-stack-1x fa-inverse text-primary sales_hover"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-7 icon_padd_right">
                                    <div class="float-right cards_content">
                                        <span class="number_val" id="sales_count"></span><i
                                                class="fa fa-arrow-up fa-2x"></i>
                                        <br/>
                                        <span class="card_description">Novo Usuario</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-sm-6 col-12">
                    <div class="bg-success top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-5  col-5 icon_padd_left">
                                <div class="float-left">
                                    <span class="fa-stack fa-sm">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-home fa-stack-1x fa-inverse text-success visit_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-7 icon_padd_right">
                                <div class="float-right cards_content">
                                    <span class="number_val" id="visitors_count"></span><i
                                            class="fa fa-arrow-up fa-2x"></i>
                                    <br/>
                                    <span class="card_description">Novo Imovel</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="bg-warning top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-5 col-5 icon_padd_left">
                                <div class="float-left">
                                    <span class="fa-stack fa-sm">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-usd fa-stack-1x fa-inverse text-warning revenue_icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-7 col-7 icon_padd_right">
                                <div class="float-right cards_content">
                                    <span class="number_val" id="revenue_count"></span>
                                        <i class="fa fa-arrow-up fa-2x"></i>
                                    <br/>
                                    <span class="card_description">Pagamentos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-12">
                    <div class="bg-mint top_cards">
                        <div class="row icon_margin_left">
                            <div class="col-lg-5 col-5 icon_padd_left">
                                <div class="float-left">
                                    <span class="fa-stack fa-sm">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-users  fa-stack-1x fa-inverse text-mint sub"></i>
                                    </span>
                                </div>
                            </div>
                                <div class="col-lg-7 col-7 icon_padd_right">
                                    <div class="float-right cards_content">
                                        <span class="number_val" id="subscribers_count"></span>
                                        <i class="fa fa-arrow-up fa-2x"></i><br/>
                                        <span class="card_description">Inscritos</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="col-xl-6 col-lg-5 col-12 stat_align">
            <div class="card weather_section md_align_section">
                <div class="card-block">
                    <div class="row margin_align">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon sun-shower">
                                        <div class="cloud"></div>
                                        <div class="sun">
                                            <div class="rays"></div>
                                        </div>
                                        <div class="rain"></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="weather-value">
                                    <span class=" text-white"><span class="degree">25&deg;</span></span>
                                    </div>
                                    <div class="weather_location">
                                        <span class="text-white"><i class="fa fa-map-marker"></i> London</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row weekly_report">
                                <div class="col-3">
                                    <span>Mon</span>
                                    <br/>
                                    <img src="{{asset('assets/img/w1.png')}}" alt="weather">
                                    <p>27&deg;</p>
                                </div>
                                <div class="col-3">
                                    <span>Tue</span>
                                    <br/>
                                    <img src="{{asset('assets/img/w2.png')}}" alt="weather">
                                    <p>23&deg;</p>
                                </div>
                                <div class="col-3">
                                    <span>Wed</span>
                                    <br/>
                                    <img src="{{asset('assets/img/w3.png')}}" alt="weather">
                                    <p>19&deg;</p>
                                </div>
                                <div class="col-3">
                                    <span>Thu</span>
                                    <br/>
                                    <img src="{{asset('assets/img/w4.png')}}" alt="weather">
                                    <p>38&deg;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
           
</div>

</div>


    <!-- /.outer -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <!--  plugin scripts -->
    <script type="text/javascript" src="{{asset('assets/vendors/raphael/js/raphael-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/d3/js/d3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/c3/js/c3.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/toastr/js/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/switchery/js/switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.js')}}" ></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.resize.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.stack.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.time.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotspline/js/jquery.flot.spline.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.categories.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flotchart/js/jquery.flot.pie.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/jquery_newsTicker/js/newsTicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/countUp.js/js/countUp.min.js')}}"></script>
    <!--end of plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/new_dashboard.js')}}"></script>
    <!-- end page level scripts -->
@stop
