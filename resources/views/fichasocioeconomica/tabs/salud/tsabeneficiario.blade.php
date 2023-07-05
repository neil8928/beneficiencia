<div id="tsabeneficiario" class="tab-pane active cont tsabeneficiario">
	<form name="frmresabeneficiario" id='frmresabeneficiario' action="#">

	    <div class="row rowform">

	    	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Que discapacidad presenta el beneficiario?</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'discapacidad', $combodiscapacidadsalud, array(),
	                        [
	                        	'class'       => 'form-control control input-xs discapacidad select2' ,
	                            'id'          => 'discapacidad',
	                            'data-aw'     => '14',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	        <div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Nivel</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'niveldiscapacidad', $comboniveldiscapacidadsalud, array(),
	                        [
	                        	'class'       => 'form-control control input-xs niveldiscapacidad select2' ,
	                            'id'          => 'niveldiscapacidad',
	                            'data-aw'     => '15',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

			<div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Especificar Tipo de discapacidad</label>
	            	<div class="abajocaja">
				    	<input type="text" class="form-control control input-xs caddiscapacidad" name="caddiscapacidad" id='caddiscapacidad' value="@if(isset($saludbeneficiario)) {{ $saludbeneficiario->tipodiscapacidad }} @endif">
	            	</div>
	          	</div>
	        </div>

	    </div>

	  	<div class="row rowform">

	    	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Cuenta con un Tipo de seguro?</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'tipodeseguro', $combotipodesegurosalud, array(),
	                        [
	                        	'class'       => 'form-control control input-xs tipodeseguro select2' ,
	                            'id'          => 'tipodeseguro',
	                            'data-aw'     => '16',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	    	<div class="col-sm-3">
				<div class="form-group">
				    <label for="cadtiposeguro"><b>Especifique</b></label>
				    <input type="text" class="form-control control input-xs" name="cadtiposeguro" id='cadtiposeguro' value="@if(isset($saludbeneficiario)) {{ $saludbeneficiario->cadtiposeguro }} @endif">
				</div>
			</div>
	        <div class="col-sm-3">
	          	<div class="form-inline divcentroderecha abajo20">
	     			<button type="button" title="Agregar Datos Beneficiario" 
	     			class="btn btn-success botoncabecera btn-lg" 
	     			id='btnagregarbeneficiario' 
	     			data_id =	'{{ $idregistro }}'
	     			data_opcion='{{$idopcion}}'
	     			>
	     				GUARDAR
	                	<span class="icon mdi mdi-save"></span>
	              	</button>
	     		</div>
	        </div>
	    </div>    
    </form>
</div>