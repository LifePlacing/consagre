<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>
        @section('title')
            | Admin
        @show
    </title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    {{--CSRF Token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- global css -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!-- end of global css -->
    
    <!--page level css-->
    
    @yield('header_styles')
   
   	<!--end of page level css-->    


</head>
<body class="skin-josh">


<header class="header">

    <a href="{{ route('admin.dashboard') }}" class="logo">
        <img src="{{ asset('imagens/logo.png') }}" alt="logo">
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <div class="responsive_nav"></div>
            </a>
        </div>

        <div class="navbar-right toggle">
            <ul class="nav navbar-nav  list-inline">


                <li class=" nav-item dropdown user user-menu">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        @if(Auth::user()->pic)
                            <img src="#" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Auth::user()->gender === "male")
                            <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @elseif(Auth::user()->gender === "female")
                            <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>

                        @else
                            <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                 class="rounded-circle img-fluid float-left"/>
                        @endif
                        <div class="riot">
                            <div>
                                <p class="user_name_max">{{ Auth::user()->name }}</p>
                                	<span>
                                        <i class="caret"></i>
                                    </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            @if(Auth::user()->pic)
                                <img src="#" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Auth::user()->gender === "male")
                                <img src="{{ asset('assets/images/authors/avatar3.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>

                            @elseif(Auth::user()->gender === "female")
                                <img src="{{ asset('assets/images/authors/avatar5.png') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>
                            @else
                                <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="img" height="35px" width="35px"
                                     class="rounded-circle img-fluid float-left"/>
                            @endif
                            <p class="topprofiletext">{{ Auth::user()->name }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="user" data-s="18"></i>
                                Meu Perfil
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="#">
                                <i class="livicon" data-name="gears" data-s="18"></i>
                                Configurações da Conta
                            </a>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#">
                                    <i class="livicon" data-name="lock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                                    Bloquear Tela
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();" >
                                    <i class="livicon" data-name="sign-out" data-s="18"></i>
                                    Sair
                                </a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								    @csrf
								</form>

                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</header>

<div class="wrapper ">
	
    <aside class="left-side ">
        <section class="sidebar ">
            <div class="page-sidebar  sidebar-nav">
                <div class="nav_icons">
                    <ul class="sidebar_threeicons">
                        <li>
                            <a href="{{ URL::to('admin/advanced_tables') }}">
                                <i class="livicon" data-name="table" title="Advanced tables" data-loop="true"
                                   data-color="#418BCA" data-hc="#418BCA" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('admin/tasks') }}">
                                <i class="livicon" data-name="list-ul" title="Tasks" data-loop="true"
                                   data-color="#e9573f" data-hc="#e9573f" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('admin/gallery') }}">
                                <i class="livicon" data-name="image" title="Gallery" data-loop="true"
                                   data-color="#F89A14" data-hc="#F89A14" data-s="25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::to('admin/users') }}">
                                <i class="livicon" data-name="user" title="Users" data-loop="true"
                                   data-color="#6CC66C" data-hc="#6CC66C" data-s="25"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <!-- BEGIN SIDEBAR MENU -->                               
                @include('admin.layouts._left_menu')                
                <!-- END SIDEBAR MENU -->
            </div>
        </section>
</aside>

<aside class="right-side">

    <!-- Notifications -->
    <div id="notific">
    @include('notifications')
    </div>

    <!-- Content -->
    @yield('content')

</aside>

<!-- global js -->

<script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>

<!-- end of global js -->
<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->


</div><!-- Fim da Wrapper -->

</body>
</html>