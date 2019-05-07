<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta HTTP-EQUIV="Access-Control-Allow-Origin">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <title>
        @section('title')
            | Admin
        @show
    </title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css' ) }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/slick-carousel/slick/slick.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/main.css?version=4.4.0') }}" rel="stylesheet">

    <style type="text/css">
      .btn_icon:hover{
        text-decoration: none!important;
      }
    </style>

    
      
    @yield('header_styles')   
</head>

<body class="menu-position-side menu-side-left full-screen">

<div class="all-wrapper solid-bg-all">

    <div class="layout-w">


    <!-- BEGIN SIDEBAR MENU -->                               
    @include('admin.layouts._partial._left_menu')                
    <!-- END SIDEBAR MENU -->              


        <div class="content-w">   

          <div class="top-bar color-scheme-transparent">

            <div class="top-menu-controls">

              <!--------------------
              START - LInks de mensagens no topo
              -------------------->

              <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-mail-14"></i>
                <div class="new-messages-count">
                  12
                </div>
                <div class="os-dropdown light message-list">
                <!-- Lista de mensagens-->
                  <ul>
                    <li></li>
                  </ul>
                  <!-- Fim da lista de Mensagens-->
                </div>
              </div>

              <!--------------------
              START - Settings Link in secondary top menu
              -------------------->
              <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-ui-46"></i>
                <div class="os-dropdown">
                  <div class="icon-w">
                    <i class="os-icon os-icon-ui-46"></i>
                  </div>
                  <ul>
                    <li>
                      <a href=""><i class="os-icon os-icon-ui-49"></i><span>Configuração de Perfil</span></a>
                    </li>
                    <li>
                      <a href=""><i class="os-icon os-icon-grid-10"></i><span>Assinaturas</span></a>
                    </li>
                    <li>
                      <a href=""><i class="os-icon os-icon-mail-01"></i><span>Minhas Mensagens</span></a>
                    </li>
                    <li>
                      <a href="users_profile_small.html"><i class="os-icon os-icon-ui-15"></i>
                        <span>Cancelar uma Conta</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            
            <!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
              <div class="logged-user-w">
                <div class="logged-user-i">
                  <div class="avatar-w">
                    <img alt="" src="{{ Auth::user()->foto !== null ? Auth::user()->foto : asset('images/profile.jpg') }}">
                  </div>
                  <div class="logged-user-menu color-style-bright">
                    <div class="logged-user-avatar-info">
                      <div class="avatar-w">
                        <img alt="" src="{{ Auth::user()->foto !== null ? Auth::user()->foto : asset('images/profile.jpg') }}">
                      </div>
                      <div class="logged-user-info-w">
                        <div class="logged-user-name">
                         {{ Auth::user()->name }}
                        </div>
                        <div class="logged-user-role">
                          Administrador
                        </div>
                      </div>
                    </div>
                    <div class="bg-icon">
                      <i class="os-icon os-icon-wallet-loaded"></i>
                    </div>
                    <ul>
                      <li>
                        <a href=""><i class="os-icon os-icon-user-male-circle2"></i>
                            <span>Detalhes Perfil</span>
                        </a>
                      </li>

                      <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" >
                                <i class="os-icon os-icon-signs-11"></i><span>Sair</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!--------------------
              END - User avatar and menu in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>

          <!--------------------
          START - Breadcrumbs
          -------------------->
          <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="index.html">Products</a>
            </li>
            <li class="breadcrumb-item">
              <span>Laptop with retina screen</span>
            </li>
          </ul>
          <!--------------------
          END - Breadcrumbs
          -------------------->

          

          <div class="content-i">

            <div class="content-box">
              <!-- Content -->
              @yield('content')

            </div>

          </div>

            @include('admin.layouts._partial._helpdesk')

        </div>

    </div>

    <div class="display-type"></div>

</div>

    
    <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('admin/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>

    <script src="{{ asset('admin/bower_components/moment/moment.js') }}"></script>
    <script src="{{ asset('admin/bower_components/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap-validator/dist/validator.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{ asset('admin/bower_components/dropzone/dist/dropzone.js') }}"></script>
    <script src="{{ asset('admin/bower_components/editable-table/mindmup-editabletable.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    
    <script src="{{ asset('admin/bower_components/tether/dist/js/tether.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/util.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/alert.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/button.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/carousel.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/collapse.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/dropdown.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/modal.js') }}"></script> 

    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/tab.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/tooltip.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap/js/dist/popover.js') }}"></script>
    
    <script src="{{ asset('admin/js/main.js?version=4.4.0') }}"></script>

@yield('footer_scripts')

</body>
</html>