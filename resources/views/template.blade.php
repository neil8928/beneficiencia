<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Sistemas de Registro de Fichas Socioeconomicas">
  <meta name="author" content="Alfas Web">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('public/img/ico.ico') }}">
  {{-- <title>{{ $Empresa }}</title> --}}
  <title>{{ $titulo }}</title>


  <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.min.css?v='.$version) }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/material-design-icons/css/material-design-iconic-font.min.css?v='.$version) }} " />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css?v='.$version) }} " />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/scroll/css/scroll.css?v='.$version) }} " />
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/css/general.css?v='.$version) }} "/> --}}

  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  @yield('style')
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css?v='.$version) }} " />
  <link rel="stylesheet" type="text/css" href="{{ asset('public/css/meta.css?v='.$version) }} " />

</head>

<body class='fuente-muktabold'>


  <div class="be-wrapper be-color-header be-nosidebar-left"  id="app">

    @include('success.ajax-alert')
    @include('success.bienhecho', ['bien' => Session::get('bienhecho')])
    @include('error.erroresurl', ['error' => Session::get('errorurl')])
    @include('error.erroresbd', ['error' => Session::get('errorbd')])

    @include('menu.nav-top')
    <!-- @include('menu.nav-left') -->

    @include('success.xml', ['xml' => Session::get('xmlmsj')])

    @yield('section')

    <input type='hidden' id='carpeta' value="{{$capeta}}" />
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
    {{-- <span class="ir-arriba icon-arrow-up2 flecha divocultar">
        <i class="text-morado fa fa-angle-up" aria-hidden="true" style="color: white !important;"></i>
    </span> --}}

  </div>
 

  <script src="{{ asset('public/lib/jquery/jquery-2.1.3.min.js?v='.$version) }}" type="text/javascript"></script>
  
  <script src="{{ asset('public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js?v='.$version) }}" type="text/javascript"></script>
  <!--<script src="{{ asset('public/js/app.js') }}" type="text/javascript"></script> -->
  
  <script src="{{ asset('public/js/main.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/bootstrap/dist/js/bootstrap.min.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/scroll/js/jquery.mousewheel.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/scroll/js/jquery-scrollpanel-0.7.0.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/scroll/js/scroll.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/general/general.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/general/generalajax.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/general/gmeta.js?v='.$version) }}" type="text/javascript"></script>

 
 


  @yield('script')
 
</body>

</html>