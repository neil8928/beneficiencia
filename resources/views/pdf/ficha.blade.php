<!DOCTYPE html>

<html lang="es">

<head>
	<title>{{$ficha->nombres}} {{$ficha->apellidopaterno}} {{$ficha->apellidomaterno}} ({{$ficha->codigo}}) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="icon" type="image/x-icon" href="{{ asset('public/favicon.ico') }}"> 

	<style type="text/css">
.izquierda{
	text-align: right;
}

.menu{
    overflow:hidden;
    width 	: 730px;
    display : table;
    /*border 	: 1px solid black;*/
}

.menu .left{
    width	: 	50%
    float	:	left;
    display : 	table-cell; 
    text-align: center;     
}


.menu .right{
    width	: 	50%
    float	:	left;
    border  :	1px solid black; 
    display : 	table-cell; 
    text-align: center; 
    border-radius: 4px ;    
}

.menu .left h1{
	font-size:  1.2em;
	/*border   :  1px solid red;*/
}
.menu .left h3{
	font-size:  0.8em;
	font-weight: normal;
	/*border   :  1px solid red;*/
}
.menu .left h4{
	font-size:  0.8em;
	font-weight: normal;	
	/*border: 1px solid blue;*/
}
.top{
    border: 1px solid #000;
    border-radius: 4px;
    padding-top: 8px;
    padding-bottom: 8px;
}

.top .det1{
	width: 718px;
	font-size: 0.8em;
	margin-top: 5px;

	padding: 5px;

}
.top .det1 p{
	margin-top: 1px;
	margin-bottom: 3px;
}

.det2{
	margin-top: 5px;
    overflow:hidden;
    width 	: 730px;
    display : table;
    font-size: 0.8em;

}

.det2 .d1,.det2 .d2,.det2 .d3{
    width	: 	32%
    float	:	left;
    display : 	table-cell;     
}

table {
    border-collapse: collapse;
    width 	: 705px;
	margin-top: 10px;
    font-size: 0.8em;    
}
.colorazul{
    color: #4285f4;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
.titulotab{
    font-style: italic;
    margin-bottom: 5px;
    font-size: 18px;
}
.titulo{
	text-align: center;
}
.codigo{
	width: 50px;
}
.descripcion{
	width: 300px;
}
.unidad{
	width: 40px;
}
.cantidad{
	width: 40px;
}
.precio{
	width: 80px;
}
.importe{
	width: 100px;
}

.m-xs{
    margin-top: 0px;
    margin-bottom: 3px;
}
.p-lrxs{
    padding-left: 8px;
    padding-right: 8px;
}

.center{
    text-align: center;
}

.totales{
	margin-top: 10px;
    overflow:hidden;
    width 	: 730px;
    display : table;
    /*border 	: 1px solid black;*/
}

.totales .left{
    width	: 	65%
    float	:	left;
    display : 	table-cell;  
   	/*border      : 1px solid red;  */ 
}


.totales .right{
    width	: 	35%
    float	:	left;
    /*border  :	1px solid black; */
    display : 	table-cell; 
      
}

.totales .right p{
	font-size 	: 0.75em;
	margin-top	: 0px;
	margin-bottom 	: 1px;	

}

.totales .right .descripcion{
	display 	: inline-block;
	width 		: 55%;

}
.totales .right .monto{
	display 	: inline-block;
	width 		: 40%;

}

.totales .left .uno{
    display     : inline-block;
    width       : 25%;
}
.totales .left .dos{
    /*border: 1px solid blue;   */ 
    display     : inline-block;
    width       : 70%;
    font-size   : 0.75em;

}
.totales .left .dos p{
    margin-top: 5px;
    margin-bottom: 5px;
}
.totales .left .derecha{
    margin-top: 55px;
}
.totales .left .uno img{
    /*border: 1px solid red;*/
    width: 100px;
    position: absolute;
    top: -87px;

}
footer .observacion{
    border-top: 1px solid #000;
    border-bottom:  1px solid #000;
}
footer .observacion h3 {
    /*border: 1px solid red;*/
    margin-top: 2px;
    margin-bottom: 2px;
    font-size: 0.9em;
}
footer .observacion p {
    /*border: 1px solid red;*/
    margin-top: 0px;
    margin-bottom: 2px;    
    font-size: 0.8em;
}
		

	</style>


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
        <br><br><br>
        @include('pdf.tab.firma')        



    </section>
</body>
</html>