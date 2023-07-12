@extends('template')
@section('style')
		<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/buttons.dataTables.min.css') }} "/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/general.css?v='.$version) }} "/>
	    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
	    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css?v='.$version) }} "/>
	    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/tab.css?v='.$version) }} "/>
  


@stop
@section('section')


<div class="panel panel-default panel-border-color panel-border-color-danger ficha">
	@include('fichasocioeconomica.cabecera')
	<div class="panel-heading">
		<div class="centrofila"> Ficha Socioeconomica</div>
	</div>

	<div class="panel-body">
		<div class="row">

			<div class="tab-container">
				<div class="col-sm-3 col-lg-2">
					@include('fichasocioeconomica.menulateraldos')
				</div>

				<div class="col-sm-9 col-lg-10">
					<div class="tab-content">

                        @include('fichasocioeconomica.tabs.datosgenerales')
                        @include('fichasocioeconomica.tabs.informacionfamiliar')
                        @include('fichasocioeconomica.tabs.salud')
                        @include('fichasocioeconomica.tabs.situacioneconomica')
                        @include('fichasocioeconomica.tabs.beneficios')
                        @include('fichasocioeconomica.tabs.vivienda')
                     	@include('fichasocioeconomica.tabs.convivenciafamiliar')
                        @include('fichasocioeconomica.tabs.evaluacionprofesional')

					</div>
    			</div>
            </div>


			</div>
	</div>
 	@include('fichasocioeconomica.modal.mobservacion')

</div>


<!-- <div class="panel panel-default panel-border-color panel-border-color-danger">
	@include('fichasocioeconomica.cabecera')
	<div class="panel-heading">
		<div class="centrofila"> Ficha Socioeconomica</div>
	</div>

	<div class="panel-body">
		<div class="row">

			<div class="tab-container">
				<div class="col-sm-3 col-lg-2">
					@include('fichasocioeconomica.menulateral')
				</div>
				<div class="col-sm-9 col-lg-10">
                    <div class="tab-content tab-content-general">
                        @include('fichasocioeconomica.tabs.datosgenerales')
                        @include('fichasocioeconomica.tabs.informacionfamiliar')
                        @include('fichasocioeconomica.tabs.salud')
                        @include('fichasocioeconomica.tabs.situacioneconomica')
                        @include('fichasocioeconomica.tabs.beneficios')
                        @include('fichasocioeconomica.tabs.vivienda')
                     	@include('fichasocioeconomica.tabs.convivenciafamiliar')
                        @include('fichasocioeconomica.tabs.evaluacionprofesional')
                    </div>
            	</div>
            </div>


			</div>
	</div>

</div> -->




@stop

@section('script')

	<script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/jszipoo.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/pdfmake.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/vfs_fonts.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app-tables-datatables.js?v='.$version) }}" type="text/javascript"></script>

  	<script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/select2/js/select2.min.js?v='.$version) }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/js/app-form-elements.js?v='.$version) }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>


	<script type="text/javascript">

	    $.fn.niftyModal('setDefaults',{
	      overlaySelector: '.modal-overlay',
	      closeSelector: '.modal-close',
	      classAddAfterOpen: 'modal-show',
	    });

		$(document).ready(function(){
			//initialize the javascript
			App.init();
			App.dataTables();
			App.formElements();
			$('[data-toggle="tooltip"]').tooltip();
		    $(".selectsalud").select2({
		      width: '100%'
		    });
		    $(".selectse").select2({
		      width: '100%'
		    });
		    $(".selectapoyo").select2({
		      width: '100%'
		    });
		});
	</script> 

	<script src="{{ asset('public/js/app/fichasocioeconomica.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/datosgenerales.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/informacionfamiliar.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/salud.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/situacioneconomica.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/evaluacionprofesional.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/vivienda.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/convivenciafamiliar.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/beneficios.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/observaciones.js?v='.$version) }}" type="text/javascript"></script>
	<script src="{{ asset('public/js/app/tabs/clonar.js?v='.$version) }}" type="text/javascript"></script>



@stop