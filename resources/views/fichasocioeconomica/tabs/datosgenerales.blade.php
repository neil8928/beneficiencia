<div id="tpdatosgenerales" class="active text-style tab-pane tpdatosgenerales">

    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Ubicación</h3>
  			</div>

            <div class="panel-body">

            	<div class="col-lg-3">
	                <div class="form-group">
	                    <label class="col-sm-12 control-label labelleft negrita">Departamento:</label>
	                    <div class="col-sm-12 abajocaja">
                      	   	{!! Form::select( 'departamento_id', $combodepartamentos, array(),
                                [
                                  'class'       => 'form-control control input-xs select2' ,
                                  'id'          => 'departamento_id',
                                  'required'    => '',
                                  'data-aw'     => '01'
                                ]) !!}

	                      </div>
	                </div>
				</div>



				<div class="col-lg-3">
					<div class="form-group ajaxprovincia">
						<label class="col-sm-12 control-label labelleft negrita">Provincia:</label>
						<div class="col-sm-12 abajocaja">
							{!! Form::select( 'provincia_id', $comboprovincias, array(),
                                [
                            		'class'       => 'form-control control input-xs select2' ,
                                    'id'          => 'provincia_id',
                                    'required'    => '',
                                    'data-aw'     => '02'
                                ]) !!}
						</div>
					</div>
				</div>



				<div class="col-lg-3">
                    <div class="form-group ajaxdistrito">
                    	<label class="col-sm-12 control-label labelleft negrita">Distrito:</label>
					  	<div class="col-sm-12 abajocaja">
					  		{!! Form::select( 'distrito_id', $combodistritos, array(),
                                [
                            		'class'       => 'form-control control input-xs select2' ,
                                    'id'          => 'distrito_id',
                                    'required'    => '',
                                    'data-aw'     => '03'
                                ]) !!}
					  	</div>
					  </div>
				</div>

				<div class="col-lg-3">
                    <div class="form-group ajaxcentropoblado">
                    	<label class="col-sm-12 control-label labelleft negrita">Centro Poblado:</label>
					  	<div class="col-sm-12 abajocaja">
					  		<input type="text" class="form-control control input-xs" name="centropoblado" id='centropoblado' placeholder="Centro Poblado"
					  		value="@if(isset($registro)) {{ $registro->centropoblado }} @endif" 
							>
					  	</div>
					  </div>
				</div>

				<div class="col-lg-12">
					<div class="form-group ajaxdireccion">
						<label class="col-sm-12 control-label labelleft negrita">Dirección de Vivienda:</label>
						<div class="col-sm-12 abajocaja">
						  		<input type="text" class="form-control control input-xs" name="direccionvivienda" id='direccionvivienda' placeholder="Centro Poblado"
						  		value="@if(isset($registro)) {{ $registro->direccion }} @endif" 
						  		>
						</div>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="panel-heading panel-heading-divider">
						<b style="font-style: italic;">Observaciones : </b> 
						<span class="mdi mdi-comment-more icoobservacion"
							data_observacion ='{{$odatosgenerales}}'
							data_ficha='{{ $idregistro }}'
							data_tab='datosgenerales'
							data_descripcion='Datos Generales'
							data_opcion='{{ $idopcion }}'
						></span>
						<span class="panel-subtitle observacion-datosgenerales">{{$odatosgenerales}}</span>
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
                    <button type="button" 
                    	id='btnguardartdg' 
                    	name='btnguardartdg' 
                    	class="btn btn-space btn-primary btnguardarprincipal" 
                    	data_opcion='{{ $idopcion }}'
                    	data_id='{{ $idregistro }}'
                    	> 
                    	Guardar 
                	</button>
                  </p>
                </div>
              </div>

	</div>




</div>