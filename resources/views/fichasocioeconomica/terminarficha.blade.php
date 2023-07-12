@extends('template')
@section('style')

		<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
		<link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

@stop
@section('section')

<div class="be-content">
	<div class="main-content container-fluid">

		<!--Basic forms-->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default panel-border-color panel-border-color-primary">
					<div class="panel-heading panel-heading-divider">TERMINAR FICHA SOCIOECONOMICA<span class="panel-subtitle">Termina Vigencia de la Ficha</span></div>
					<div class="panel-body">

						<form name="frmterminarficha" id='frmterminarficha' method="POST" action="{{ url('/terminar-ficha-socieconomica/'.$idopcion.'/'.$idregistro) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
								{{ csrf_field() }}

							<div class="col-sm-8 col-sm-offset-2">
								<div class="form-group">
									<label class="col-sm-3 control-label negrita">Fecha Fin</label>
									<div class="col-sm-6">

									       <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker input-sm">
													<input size="12" type="text" value="{{ date_format(date_create(date('d-m-Y')),'d-m-Y') }}" 
													placeholder="Fecha"
													id = 'fecha' name='fecha' 
													autocomplete="off"
													required =''
													class="form-control input-sm">
													<span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
											</div>
									  </div>
								</div> 

							   	<div class="form-group sectionclonarusuario">
					                <label class="col-sm-3 control-label negrita">Descripcion</label>
					                <div class="col-sm-6">
										<textarea 
									        name="descripcion"
									        id = "descripcion"
									        class="form-control input-sm"
									        rows="5" 
									        cols="50"
									        required = ""
									        data-aw="7"></textarea>
									</div>
				             	</div>

							</div>		             	
							
							<div class="row xs-pt-15">
								<div class="col-xs-6">
										<div class="be-checkbox">

										</div>
								</div>
								<div class="col-xs-6">
									<p class="text-right">
										<a href="{{ url('/gestion-ficha-socieconomica/'.$idopcion) }}"><button type="button"  id ='btnatras' name='btnatras' class="btn btn-space btn-danger">Cancelar</button></a>
										<button type="submit"  id ='btnagregarregistro' name='btnagregarregistro' class="btn btn-space btn-primary">Guardar</button>
									</p>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>  

@stop


@section('script')


	<script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>
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

  	<script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/select2/js/select2.min.js?v='.$version) }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  	<script src="{{ asset('public/js/app-form-elements.js?v='.$version) }}" type="text/javascript"></script>
  	<script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				//initialize the javascript
				App.init();
				App.formElements();
				$('form').parsley();
			});
		</script> 

	<script src="{{ asset('public/js/app/fichasocioeconomica.js?v='.$version) }}" type="text/javascript"></script>

@stop
