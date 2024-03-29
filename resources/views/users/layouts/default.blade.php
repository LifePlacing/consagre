<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="robots" content="noindex">

	<title>{{ config('app.name', 'Consagre Imoveis') }}</title>

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">    

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('users/css/bootstrap.min.css') }}" rel="stylesheet" />

    
    <!-- Animation library for notifications   -->
    <link href="{{ asset('users/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('users/css/demo.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('users/css/jquery-ui.min.css') }}">
   

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('users/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="{{ asset('users/css/font-awesome.min.css')}}" rel="stylesheet">
    
    <link href='https://fonts.googleapis.com/css?family=Abril+Fatface|Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('users/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cube-adm.css')}}">

    <script src="{{ asset('js/app.js') }}" defer></script>

   
    <!-- end of global styles-->
    @yield('header_styles')

</head>

<body>

    <div id="app">

    <div class="loading hidden" id="load_message">
        <div class="sk-cube-grid" >
              <div class="sk-cube sk-cube1"></div>
              <div class="sk-cube sk-cube2"></div>
              <div class="sk-cube sk-cube3"></div>
              <div class="sk-cube sk-cube4"></div>
              <div class="sk-cube sk-cube5"></div>
              <div class="sk-cube sk-cube6"></div>
              <div class="sk-cube sk-cube7"></div>
              <div class="sk-cube sk-cube8"></div>
              <div class="sk-cube sk-cube9"></div>
        </div>  
    </div>
      
        <div class="wrapper">

            <!-- Sidebar -->
                @include('users.inc._left')
            <!-- Fim Sidebar -->        

            <main class="py-4">

                <div class="main-panel">
                    <nav class="navbar navbar-default navbar-fixed">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="{{ Auth::user()->tipo ? route('anunciante.dashboard'): route('home') }}">Painel do  {{ Auth::user()->tipo ? Auth::user()->tipo : " Usuário " }} </a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-left">

                                    <li>
                                       <a href="">
                                            <i class="fa fa-search"></i>
                                            <p class="hidden-lg hidden-md">Buscar</p>
                                        </a>
                                    </li>

                                </ul>

                                <ul class="nav navbar-nav navbar-right">

                                    <li>
                                        @if( verificaMensagens(Auth::user()->id) > 0) 

                                            <a href="{{ route('listar.mensagens') }}" style="color: #d9534f;">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                <span class="badge" style="background: #d9534f; color:#fff;">
                                                    {{ verificaMensagens(Auth::user()->id) }}
                                                </span>
                                            </a>

                                        @else
                                            <a href="#" style="color: #049F0C;" >
                                                <i class="fa fa-envelope-open-o" aria-hidden="true"></i>
                                                <span class="badge" style="background:#049F0C; color:#fff; ">0</span>
                                            </a>
                                        @endif
                                        
                                    </li>

                                    <li>
                                       <a href="{{ isset(Auth::user()->tipo) ? route('anunciante.profile') : route('account.show') }}">
                                           Minha Conta
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <p>Sair</p>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </li>
                                    <li class="separator hidden-lg"></li>


                                </ul>
                            </div>
                        </div>
                    </nav>


                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                @yield('content')                            
                            </div>
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container-fluid">
                            <p class="copyright pull-right">&copy;  <a href="#">Consagre Imoveis</a>    </p>
                        </div>
                    </footer>

                </div>


            </main>

        </div>

    </div> 


</body>



    <!--   Core JS Files --> 
    <script src="{{ asset('users/js/jquery.3.2.1.min.js')}}"></script>
    <script src="{{ asset('users/js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('users/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('users/js/moment.min.js')}} " type="text/javascript"></script>     

    <script src="{{ asset('users/js/fullcalendar.min.js')}} " type="text/javascript"></script>
    <script src="{{ asset('users/js/pt-br.js')}}" type="text/javascript"></script>
    
    <!--  Charts Plugin -->
   <script src="{{ asset('users/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('users/js/bootstrap-notify.js') }}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ asset('users/js/light-bootstrap-dashboard.js?v=1.4.0') }}">
        
    </script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! 
    <script src="{{ asset('users/js/demo.js')}}"></script>-->

    <script src="{{ asset('users/js/notifica.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

    @hasSection('footer_scripts')
        @yield('footer_scripts')
    @endif

    <script>

        $('.char-count').keyup(function() {
            var maxLength = parseInt($(this).attr('maxlength')); 
            var length = $(this).val().length;
            var newLength = maxLength-length;
            var name = $(this).attr('name');
            $('span[name="'+name+'"]').text(newLength);
            $('.description').text($(this).val());

        });  


        $("#phone").mask("(00) 00000-0000");

        $(function(){

            $("#upload_link").hover(function(){
                $(this).append( $( '<span style="background:#000; color:#fff; font-size:22px;  position:absolute; right:122px; top:87px; z-index:2; font-weight:600; width:115px; height:115px; border-radius:50%; padding:40px 15px; opacity:0.7;" class="foto_upload"> Editar </span>' ) );
            }, function() {
                $(this).find( "span:last" ).remove();
            }); 

            $("#upload_link").on('click', function(e){
                e.preventDefault();
                $("#upload").trigger('click');
            });

            $('#upload').change(function(){

                if ($('#upload').val()!=''){

                    var reader = new FileReader();
                    
                    reader.onload = function(e) {                    
                       
                      $('#avatar').attr('src', e.target.result);

                    }                   

                    reader.readAsDataURL(this.files[0]);                   

                    $('#foto_perfil').trigger('submit');
                }

            });


        });
      
    </script>



    @if (session('errors'))
       
        <script type="text/javascript">

            var msg = "{{ session('errors') }}";
            var tipo = 'danger';

            notifica.showNotification('top','right', msg, 'pe-7s-attention', tipo);

        </script>

    @endif

    @if (session('success'))
       
        <script type="text/javascript">

            var msg = "{{ session('success') }}";
            var tipo = 'success';

            notifica.showNotification('top','right', msg, 'pe-7s-check', tipo);

        </script>

    @endif


</html>              