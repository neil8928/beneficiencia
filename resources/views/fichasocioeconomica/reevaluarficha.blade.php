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
					<div class="panel-heading panel-heading-divider">REEVALUAR FICHA SOCIOECONOMICA<span class="panel-subtitle">Reevaluar Ficha
						/ Beneficiario: {{ $beneficiario->apellidopaterno }} {{ $beneficiario->apellidomaterno }} {{ $beneficiario->nombres }}
						/ Ficha : {{ $registro->codigo }}
					</span>
					<div class="panel-body">

						<form name="frmreevaluarficha" id='frmreevaluarficha' method="POST" action="{{ url('/reevaluar-ficha-socieconomica/'.$idopcion.'/'.$idregistro) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
								{{ csrf_field() }}

							<div class="col-sm-8 col-sm-offset-2">
								<div class="form-group">
									<label class="col-sm-3 control-label negrita">Fecha Inicio</label>
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



								<div class="form-group">

								          <label class="col-sm-3 control-label negrita">Clonar Datos Beneficiario</label>

								          <div class="col-sm-6">
								            	<div class="be-radio has-success inline">
										              <input type="radio" value='1' checked 
										              name="indclonarbeneficiario" class="indclonarbeneficiario" id="rad48">
										              <label for="rad48">SI</label>
								            	</div>
								            	<div class="be-radio has-danger inline">
										              <input type="radio" value='0' 
										              name="indclonarbeneficiario" class="indclonarbeneficiario" id="rad49">
										              <label for="rad49">NO</label>
								            	</div>
								          </div>
								</div>

							
								<div class="panel panel-default panel-general">
						       		<div class="panel-heading">
						    			<h3 class="panel-title negrita">Secciones Ficha</h3>

						    			<div class="form-group">

										    <label class="col-sm-3 control-label negrita">Clonar Datos Ficha</label>
								          	<div class="col-sm-6">
								            	<div class="be-radio has-success inline">
										              <input type="radio" value='1' checked 
										              name="indclonardatos" class="indclonardatos" id="rad50">
										              <label for="rad50">SI</label>
								            	</div>
								            	<div class="be-radio has-danger inline">
										              <input type="radio" value='0' 
										              name="indclonardatos" class="indclonardatos" id="rad51">
										              <label for="rad51">NO</label>
								            	</div>
								          	</div>
										</div>

						  			</div>

						            <div class="panel-body indsectionficha" id='indsectionficha'>
						            	<div class="panel panel-default panel-general">
						            		<div class="panel-body">

							            		{{-- <div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Datos Informacion Familiar</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpif" class="indclonartpif" id="rad52">
														        <label for="rad52">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpif" class="indclonartpif" id="rad53">
														    	<label for="rad53">NO</label>
												            </div>
											          	</div>
													</div>
												</div> --}}

												<div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Datos Salud</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpsa" class="indclonartpsa" id="rad46">
														        <label for="rad46">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpsa" class="indclonartpsa" id="rad47">
														    	<label for="rad47">NO</label>
												            </div>
											          	</div>
													</div>
												</div>

												<div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Situacion Economica</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpse" class="indclonartpse" id="rad44">
														        <label for="rad44">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpse" class="indclonartpse" id="rad45">
														    	<label for="rad45">NO</label>
												            </div>
											          	</div>
													</div>
												</div>

												<div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Datos Beneficios</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpbe" class="indclonartpbe" id="rad55">
														        <label for="rad55">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpbe" class="indclonartpbe" id="rad56">
														    	<label for="rad56">NO</label>
												            </div>
											          	</div>
													</div>
												</div>

												<div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Datos Vivienda</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpvi" class="indclonartpvi" id="rad57">
														        <label for="rad57">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpvi" class="indclonartpvi" id="rad58">
														    	<label for="rad58">NO</label>
												            </div>
											          	</div>
													</div>
												</div>

												<div class="row">
									            	<div class="form-group">
												        <label class="col-sm-3 control-label negrita">Clonar Datos Convivencia</label>
												        <div class="col-sm-6">
												        	<div class="be-radio has-success inline">
														    	<input type="radio" value='1' checked 
														        	name="indclonartpcf" class="indclonartpcf" id="rad59">
														        <label for="rad59">SI</label>
												           	</div>
												            <div class="be-radio has-danger inline">
														        <input type="radio" value='0' 
														              name="indclonartpcf" class="indclonartpcf" id="rad60">
														    	<label for="rad60">NO</label>
												            </div>
											          	</div>
													</div>
												</div>

								            </div>
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
