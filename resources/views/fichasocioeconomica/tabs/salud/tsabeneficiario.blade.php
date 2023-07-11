<div id="tsabeneficiario" class="tab-pane active cont tsabeneficiario">
	<form name="frmresabeneficiario" id='frmresabeneficiario' action="#">

	    <div class="row rowform">

	    	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Que discapacidad presenta el beneficiario?</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'discapacidad', $combodiscapacidad, array(),
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
	             	 	{!! Form::select( 'niveldiscapacidad', $comboniveldiscapacidad, array(),
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
				    	<input type="text" class="form-control control input-sm caddiscapacidad" name="caddiscapacidad" id='caddiscapacidad' value="">
	            	</div>
	          	</div>
	        </div>

	    </div>

	  	<div class="row rowform">

	    	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Cuenta con un Tipo de seguro?</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'tipodeseguro', $combotipodesegurobe, array(),
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
				    <input type="text" class="form-control control input-sm" name="cadtiposeguro" id='cadtiposeguro' value="">
				</div>
			</div>

 			<div class="col-sm-3">
	          	<div class="form-inline divcentroderecha">
	    			
	    			<button type="reset" title="Limpiar" 
	     			class="btn btn-primary botoncabecera btn-lg" 
	     			id='btnlimpiarregistros' 
	     			>
	                	<span class="icon mdi mdi-delete"></span>
	              	</button>
					&nbsp;
					@if($swmodificar==1)
	     			<button type="button" title="Agregar Datos Beneficiario" 
	     			class="btn btn-success botoncabecera btn-lg" 
	     			id='btnagregarbeneficiario' 
	     			data_id ='{{ $idregistro }}'
	     			data_opcion='{{$idopcion}}'
	     			>
	                	<span class="icon mdi mdi-save"></span>
	              	</button> &nbsp;
	              	@endif
	              	<button type="button" title="Mostrar Datos" class="btn btn-primary botoncabecera btn-lg" id='btnmostrartif' data_opcion='{{$idopcion}}'>
	                	<span class="icon mdi mdi-assignment-o"></span>
	              	</button>
	     		</div>
		    </div>
 
		</div>
    
    </form>
    
    <div class="contenedortabla" id='conttableinffam'>
    	<div class="ajaxtablaifbeneficiariosalud">
    		@if($swmodificar==1)
				@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsaluddiscapacidad', [
		        	'listadiscapacidad' => $listadiscapacidadbeneficiario,
					'swelim'=>true
		   		])
		   	@else
		   		@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsaluddiscapacidad', [
	        		'listadiscapacidad' => $listadiscapacidadbeneficiario,
				])
		   	@endif

    	</div>
	</div>

