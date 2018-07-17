<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Consagre Imoveis') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">

</head>
<body id="sign-in">
	<div id="app">

		<div class="preloader">
		<div class="loader_img"><img src="{{asset('images/loader.gif')}}" alt="loading..." height="64" width="64"></div>
		</div>

	    <main class="py-4 ">
	        @yield('content')            
	    </main>
	</div>

	<script src="{{ asset('js/all.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/custom_js/login.js')}}"></script>
</body>
</html>   
