<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @section('title')
            | {{ config('app.name') }}
        @show
    </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/img/logo-ico.svg')}}"/>

    <!-- global styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}"/>

    <!-- end of global styles-->
    @yield('header_styles')

</head>

<body  class="fixedMenu_header">

    <div class="preloader" style=" position: fixed;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          z-index: 100000;
          backface-visibility: hidden;
          background: #ffffff;">
        <div class="preloader_img" style="width: 200px;
              height: 200px;
              position: absolute;
              left: 48%;
              top: 48%;
              background-position: center;
            z-index: 999999">
            <img src="{{asset('assets/img/loader.gif')}}" style=" width: 40px;" alt="Aguarde...">
        </div>
    </div>

<div class="bg-dark" id="wrap">
    <div id="top" class="fixed">
        <!-- .navbar -->
        <nav class="navbar navbar-static-top">
            <div class="container-fluid m-0">
                <a class="navbar-brand float-left text-center" href="index">
                    <h4 class="text-white">
                        <img src="{{asset('assets/img/logow.svg')}}" class="admin_img" alt="logo">{{ config('app.name')}} </h4>
                </a>
                <div class="menu">
                    <span class="toggle-left" id="menu-toggle">
                        <i class="fa fa-bars text-white"></i>
                    </span>
                </div>
                <div class="topnav dropdown-menu-right float-right">

                    <div class="btn-group">

                        <div class="notifications no-bg">

                            <a class="btn btn-default btn-sm messages" data-toggle="dropdown"> 
                                <i class="fa fa-envelope fa-1x text-white"></i>
                                <span class="badge badge-warning">2</span>
                            </a>

                            <div class="dropdown-menu drop_box_align" role="menu" id="messages_dropdown">

                                <div class="popover-title">Você tem mensagens</div>
                                <div id="messages">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                
                                            <img src="{{asset('assets/img/mailbox_imgs/5.jpg')}}" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <strong>hally</strong>
                                                sent you an image.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/8.jpg')}}" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data"><strong>Meri</strong>
                                                invitation for party.
                                                <br>
                                                <small>add to timeline</small>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="popover-footer">
                                    <a href="mail_inbox">Ler todas</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="btn-group">
                        <div class="notifications messages no-bg">
                            <a class="btn btn-default btn-sm" data-toggle="dropdown"> <i class="fa fa-bell text-white"></i>

                                <span class="badge badge-danger">2</span>
                            </a>
                            <div class="dropdown-menu drop_box_align" role="menu">
                                <div class="popover-title">Você tem Notificações</div>
                                <div id="notifications">
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/1.jpg')}}" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>Remo</strong>
                                                sent you an image
                                                <br>
                                                <small class="primary_txt">just now.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="row">
                                            <div class="col-2">
                                                <img src="{{asset('assets/img/mailbox_imgs/2.jpg')}}" class="message-img avatar rounded-circle"
                                                     alt="avatar1"></div>
                                            <div class="col-10 message-data">
                                                <i class="fa fa-clock-o"></i>
                                                <strong>clay</strong>
                                                business propasals
                                                <br>
                                                <small class="primary_txt">20min Back.</small>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
 

                                </div>
                                <div class="popover-footer">
                                    <a href="#">Ver todas</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group">
                        <div class="user-settings no-bg">

                            <button type="button" class="btn btn-default no-bg micheal_btn" data-toggle="dropdown">
                                <img src="{{asset('assets/img/admin.jpg')}}" class="admin_img2 rounded-circle avatar-img" alt="avatar"> <strong>                               
                                    {{Auth::user()->name}}

                                </strong>
                                <span class="fa fa-sort-down white_bg"></span>
                            </button>

                            <div class="dropdown-menu admire_admin">

                                <a class="dropdown-item" href="edit_user">
                                <i class="fa fa-cogs"></i>
                                Configurações
                                </a>

                                <a class="dropdown-item" href="mail_inbox">
                                <i class="fa fa-envelope"></i>
                                Mensagens
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                   <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </nav>

</div>

    <!-- /#top -->
<div class="wrapper">

    <div id="left" class="fixed">
        
        <div class="menu_sction menu_scroll">
                <div class="media user-media bg-dark dker">
                    <div class="user-media-toggleHover">
                        <span class="fa fa-user"></span>
                    </div>
                    <div class="user-wrapper bg-dark">
                    
                    <a class="user-link" href="">
                    <img class="media-object img-thumbnail user-img rounded-circle admin_img3" alt="Usuario" src="{{asset('assets/img/admin.jpg')}}">
                    <p class="text-white user-info">Bem Vindo {{Auth::user()->name}} </p>
                    
                    </a>

            </div>
        </div>

        <!-- #menu -->
        <ul id="menu" class="bg-blue dker">

            <li {!! (Request::is('index')? 'class="active"':"") !!}>
                <a href="{{ URL::to('index') }} ">
                    <i class="fa fa-home fa-2x"></i>
                    <span class="link-title">&nbsp;Painel de Controle</span>
                </a>
            </li>


            <li {!! (Request::is ('widgets')|| Request::is('widgets2')? 'class="active"':"" )!!}>
                <a href="javascript:;">
                    <i class="fa fa-th-large fa-2x"></i>
                    <span class="link-title">&nbsp; Widgets</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('widgets')? 'class="active"':"") !!}>
                        <a href="{{URL::to('widgets')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Widgets1
                        </a>
                    </li>
                    <li {!! (Request::is('widgets2')? 'class="active"':"") !!}>
                        <a href="{{URL::to('widgets2')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Widgets2
                        </a>
                    </li>
                </ul>
            </li>

            <li {!! (Request::is('users')|| Request::is('add_user') || Request::is('view_user')|| Request::is('delete_user')? 'class="active"':"")!!}>
            <a href="#">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="link-title">&nbsp; Users</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('users')? 'class="active"':"") !!}>
                        <a href="{{URL::to('users')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; User Grid
                        </a>
                    </li>
                    <li {!! (Request::is('add_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('add_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Add User
                        </a>
                    </li>
                    <li {!! (Request::is('view_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('view_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; User Profile
                        </a>
                    </li>
                    <li {!! (Request::is('delete_user')? 'class="active"':"") !!}>
                        <a href="{{URL::to('delete_user')}} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Delete User
                        </a>
                    </li>
                </ul>
            </li>
            <li {!! (Request::is('calendar')? 'class="active"':"") !!}>
                <a href="{{ URL::to('calendar') }} ">
                    <i class="fa fa-calendar fa-2x"></i>
                    <span class="link-title">&nbsp; Calendar</span>
                    <span class="badge badge-pill badge-primary float-right calendar_badge">7</span>
                </a>
            </li>

            <li {!! (Request::is('maps')|| Request::is('jqvmaps') ? 'class="active"' : '') !!}>
            <a href="#">
                    <i class="fa fa-map-marker fa-2x"></i>
                    <span class="link-title">&nbsp; Maps</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>
                    <li {!! (Request::is('maps')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('maps') }} ">
                            <i class="fa fa-angle-right fa-2x"></i>
                            &nbsp; Google Maps
                        </a>
                    </li>
                    <li {!! (Request::is('jqvmaps')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('jqvmaps') }} ">
                            <i class="fa fa-angle-right fa-2x"></i>
                            &nbsp; Vector Maps
                        </a>
                    </li>
                </ul>
            </li>
            <li {!! (Request::is('404')|| Request::is('500') || Request::is('login')|| Request::is('register')|| Request::is('lockscreen')|| Request::is('invoice')|| Request::is('blank') ? 'class="active"' : '') !!}>
                <a href="javascript:;">
                    <i class="fa fa-file fa-2x"></i>
                    <span class="link-title">&nbsp; Paginas</span>
                    <span class="fa arrow"></span>
                </a>
                <ul>

                    <li {!! (Request::is('blank')? 'class="active"':"") !!}>
                        <a href="{{ URL::to('blank') }} ">
                            <i class="fa fa-angle-right"></i>
                            &nbsp; Blank Page
                        </a>
                    </li>
                </ul>

            <li>
                <a href="javascript:;">
                    <i class="fa fa-sitemap fa-2x"></i>
                    <span class="link-title">&nbsp; Menu</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-angle-right"></i>
                            &nbsp;Level 1
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu sub-submenu">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="sub-menu sub-submenu">
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 3
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 3
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 3
                                            <span class="fa arrow"></span>
                                        </a>
                                        <ul class="sub-menu sub-submenu">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 4
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 4
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-angle-right"></i>
                                                    &nbsp;Level 4
                                                    <span class="fa arrow"></span>
                                                </a>
                                                <ul class="sub-menu sub-submenu">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 5
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 5
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                            &nbsp;Level 5
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <i class="fa fa-angle-right"></i>
                                            &nbsp;Level 4
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-angle-right"></i>
                            &nbsp;Level 1
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="fa fa-angle-right"></i>
                            &nbsp;Level 1
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu sub-submenu">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-angle-right"></i>
                                    &nbsp;Level 2
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
</div>

</div>

<!-- FIM left sidebar -->
        
<!-- Content -->

<div id="content" class="bg-container">

    @yield('content')

</div>

<!-- Content end -->

</div>


<!-- # right side -->

</div>

<!-- global scripts-->
<script type="text/javascript" src="{{asset('assets/js/components.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<!-- end of global scripts-->
<!-- page level js -->
@yield('footer_scripts')
<!-- end page level js -->


<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif
</script>

</body>
</html>