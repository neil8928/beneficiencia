<!DOCTYPE html>

<html lang="es">

<head>
	<title>{{$ficha->nombres}} {{$ficha->apellidopaterno}} {{$ficha->apellidomaterno}} ({{$ficha->codigo}}) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}"> 
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/pdf.css') }} "/>


</head>

<body>
    <header>
	<div class="menu">
	    <div class="left" style="text-align:left;">
	    		<div>
	    			<img src="{{ asset('public/img/logo.jpg') }}" alt="logo" width="180" height="80" class="logo-img">
	    		</div>
	    </div>
	    <div class="right" style="text-align:right;border: 0px;">
	    		<h5>Sociedad de Beneficencia de Lambayeque <br>
	    			{{$ficha->codigo}}<br>
	    			{{date_format(date_create($ficha->fecha), 'd/m/Y')}}
	    		</h5>
	    </div>
	    <div class='center'>
	    	<h3 class='center'>Ficha Socioeconomica</h3>
	    </div>
	</div>
    </header>
    <section>
        @include('pdf.tab.ubicacion')
        <br>
        @include('pdf.tab.tabinformacionfamiliar')
        <br>
        @include('pdf.tab.tabsalud')
        <br>
        @include('pdf.tab.tabsituacioneconomica')
        <br>
        @include('pdf.tab.tabbeneficios')
        <br>
        @include('pdf.tab.tabvivienda')
        <br>
        @include('pdf.tab.tabconvivenciafamiliar')
        <br>
        @include('pdf.tab.tabevaluacionprofesional')


    </section>
</body>
</html>