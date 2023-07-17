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
					<div class="panel-heading panel-heading-divider">AGREGAR VARIABLE PERMANENCIA<span class="panel-subtitle">Crear una nueva Variable</span></div>
					<div class="panel-body">

						<form name="frmregistrarpermanencia" id='frmregistrarpermanencia' method="POST" action="{{ url('/registrar-'.$url.'/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
								{{ csrf_field() }}

							<div class="col-sm-8 col-sm-offset-2">
								
				             	<div class="form-group">
						                <label class="col-sm-3 control-label negrita">Descripcion</label>
						                <div class="col-sm-6">
						                  <textarea rows="4" name='descripcion' id='descripcion' required class="form-control" data-aw="1"></textarea>
						                </div>
					            </div>

								
					            <div class="form-group">
				                        <label class="col-sm-3 control-label negrita">Edad Minima</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="number" value='0' step="1" min="0" 
				                                name="edadmin" class="edadmin form-control input-sm" id="edadmin">
				                            </div>

				                        </div>
				              	</div>
				              	
					            <div class="form-group">
				                        <label class="col-sm-3 control-label negrita">Edad Maxima</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="number" value='0' step="1" min="0" 
				                                name="edadmax" class="edadmax form-control input-sm" id="edadmax">
				                            </div>

				                        </div>
				              	</div>

					            <div class="form-group">

				                        <label class="col-sm-3 control-label negrita">Evaluar Vulnerabilidad</label>

				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="radio" value='0' checked 
				                                name="indvulnerabilidad" class="indvulnerabilidad form-control input-sm" id="rad75">
				                                <label for="rad75">NO</label>
				                            </div>
				                            <div class="be-radio has-success inline">
				                                <input type="radio" value='1' 
				                                name="indvulnerabilidad" class="indvulnerabilidad form-control input-sm" id="rad76"> 
				                                <label for="rad76">SI</label>
				                            </div>
				                        </div>
				              	</div>




				              	<div class="form-group">

				                        <label class="col-sm-3 control-label negrita">Evaluar Riesgo Social</label>

				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="radio" value='0' checked 
				                                name="indriesgosocial" class="indriesgosocial form-control input-sm" id="rad77">
				                                <label for="rad77">NO</label>
				                            </div>
				                            <div class="be-radio has-success inline"> 
				                                <input type="radio" value='1'
				                                name="indriesgosocial" class="indriesgosocial form-control input-sm" id="rad78">
				                                <label for="rad78">SI</label>
				                            </div>
				                        </div>
				              	</div>



				              	<div class="form-group">
				                        <label class="col-sm-3 control-label negrita">Evaluar Sueldo</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="radio" value='0' checked 
				                                name="indsueldo" class="indsueldo form-control input-sm" id="rad79">
				                                <label for="rad79">NO</label>
				                            </div>
				                            <div class="be-radio has-success inline"> 
				                                <input type="radio" value='1'
				                                name="indsueldo" class="indsueldo form-control input-sm" id="rad80">
				                                <label for="rad80">SI</label>
				                            </div>
				                        </div>
				              	</div>
					              
					              
				              	<div class="form-group sectionsueldomaximo">
				                        <label class="col-sm-3 control-label negrita">Sueldo Maximo</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="number" value='0'
				                                name="sueldomaximo" class="form-control input-sm" id="sueldomaximo">
				                            </div>

				                        </div>
				              	</div>


				              	<div class="form-group">
				                        <label class="col-sm-3 control-label negrita">Evaluar Cantidad Personas</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="radio" value='0' checked 
				                                name="indcantpersonas" class="indcantpersonas form-control input-sm" id="rad81">
				                                <label for="rad81">NO</label>
				                            </div>
				                            <div class="be-radio has-success inline"> 
				                                <input type="radio" value='1'
				                                name="indcantpersonas" class="indcantpersonas form-control input-sm" id="rad82">
				                                <label for="rad82">SI</label>
				                            </div>
				                        </div>
				              	</div>
					              
				              	<div class="form-group sectioncantidadpersonas">
				                        <label class="col-sm-3 control-label negrita">Cantidad Personas</label>
				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="number" value='0' step="1" min='0' 
				                                name="cantpersonas" class="cantpersonas form-control input-sm" id="cantpersonas">
				                            </div>

				                        </div>
				              	</div>

								<div class="form-group">

				                        <label class="col-sm-3 control-label negrita">Sin Limite de Permanencia</label>

				                        <div class="col-sm-6">
				                            <div class="be-radio has-danger inline">
				                                <input type="radio" value='0' checked 
				                                name="indsinlimite" class="indsinlimite form-control input-sm" id="rad27">
				                                <label for="rad27">NO</label>
				                            </div>
				                            <div class="be-radio has-success inline">
				                                <input type="radio" value='1' 
				                                name="indsinlimite" class="indsinlimite form-control input-sm" id="rad28"> 
				                                <label for="rad28">SI</label>
				                            </div>
				                        </div>
				              	</div>

				              	<div class="sectionlimiteduracion">
				              		
					              	<div class="form-group">
					                        <label class="col-sm-3 control-label negrita">Duracion Años</label>
					                        <div class="col-sm-6">
					                            <div class="be-radio has-danger inline">
					                                <input type="number" value='0' step="1" min="0" 
					                                name="anios" class="anios form-control input-sm" id="anios">
					                            </div>

					                        </div>
					              	</div>

						 
					              	<div class="form-group">
					                        <label class="col-sm-3 control-label negrita">Duracion Meses</label>
					                        <div class="col-sm-6">
					                            <div class="be-radio has-danger inline">
					                                <input type="number" value='0' step="1" min="0"  
					                                name="meses" class="meses form-control input-sm" id="meses">
					                            </div>

					                        </div>
					              	</div>

						 
					              	<div class="form-group">
					                        <label class="col-sm-3 control-label negrita">Duracion Dias</label>
					                        <div class="col-sm-6">
					                            <div class="be-radio has-danger inline">
					                                <input type="number" value='0' step="1" min="0"  
					                                name="dias" class="dias form-control input-sm" id="dias">
					                            </div>

					                        </div>
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
										<a href="{{ url('/gestion-'.$url.'/'.$idopcion) }}"><button type="button"  id ='btnatras' name='btnatras' class="btn btn-space btn-danger">Cancelar</button></a>
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
            	$('.sectionclonarusuario').hide(600);            
            	$('.sectionsueldomaximo').hide(600);            
            	$('.sectioncantidadpersonas').hide(600);   
            	// $('.sectionlimiteduracion').hide(600);   

			});
		</script> 

	<script src="{{ asset('public/js/app/fichasocioeconomica.js?v='.$version) }}" type="text/javascript"></script>

@stop
