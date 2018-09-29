<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

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

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('users/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('users/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />

</head>

<body>

    <div id="app">

      
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
                                <a class="navbar-brand" href="#">Dashboard</a>
                            </div>
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav navbar-left">
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-dashboard"></i>
                                            <p class="hidden-lg hidden-md">Dashboard</p>
                                        </a>
                                    </li>
                                    <li>
                                       <a href="">
                                            <i class="fa fa-search"></i>
                                            <p class="hidden-lg hidden-md">Buscar</p>
                                        </a>
                                    </li>


                                </ul>

                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                       <a href="{{ route('account.show') }}">
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
                            <nav class="pull-left">
                                <ul>
                                    <li>
                                        <a href="{{ url('/') }}">
                                            Home
                                        </a>
                                    </li>

                                </ul>
                            </nav>
                            <p class="copyright pull-right">&copy;  <a href="#">Consagre Imoveis</a>    </p>
                        </div>
                    </footer>

                </div>


            </main>

        </div>

    </div> 


</body>

    <!--   Core JS Files -->  
    <script src="{{ asset('users/js/jquery.3.2.1.min.js')}} " type="text/javascript"></script>
    <script src="{{ asset('users/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="{{ asset('users/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('users/js/bootstrap-notify.js') }}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="{{ asset('users/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="{{ asset('users/js/demo.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 


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






</html>              