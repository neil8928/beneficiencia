<div id="tsaotros" class="tab-pane cont tsaotros">
	<form name="frmresaotros" id='frmresaotros' action="#">
	     <div class="row rowform">

	     	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Seleccione Familiar</label>
	            	<div class="abajocaja combofamiliares" id='combofamiliaresof'>
	             	 	{!! Form::select( 'familiar', $combofamiliares, array(),
	                        [
	                        	'class'       => 'form-control control input-xs familiarof select2' ,
	                            'id'          => 'familiar',
	                            'data-aw'     => '14',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	    	<div class="col-sm-6">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Especificar Enfermedad</label>
	            	<div class="abajocaja">
						<input type="text" class="form-control control input-xs cadenfermedad" name="cadenfermedad" id='cadenfermedad' value="">
	            	</div>
	          	</div>
	        </div>

	    </div>

	    
	   	<div class="row rowform">

	    	<div class="col-sm-9">
	          	
	        </div>

	        <div class="col-sm-3">
	          	<div class="form-inline divcentroderecha">
	    			
	    			<button type="reset" title="Limpiar" 
	     			class="btn btn-primary botoncabecera btn-lg" 
	     			id='btnlimpiarregotros' 
	     			>
	                	<span class="icon mdi mdi-delete"></span>
	              	</button>
					&nbsp;
	     			<button type="button" title="Agregar Otro Familiar" 
	     			class="btn btn-success botoncabecera btn-lg" 
	     			id='btnagregarotrofamiliar' 
	     			data_id ='{{ $idregistro }}'
	     			data_opcion='{{$idopcion}}'
	     			>
	                	<span class="icon mdi mdi-save"></span>
	              	</button> &nbsp;
	              	<button type="button" title="Mostrar Datos" class="btn btn-primary botoncabecera btn-lg" id='btnmostrartif' data_opcion='{{$idopcion}}'>
	                	<span class="icon mdi mdi-assignment-o"></span>
	              	</button>
	     		</div>
	        </div>
	    </div>   

    </form>

    <div class="contenedortabla" id='conttableinffam'>
    	<div class="ajaxtablaifotrossalud">
			@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsalud', [
	        	'listafamiliares' => $listafamiliaressalud,
	   		])

    	</div>

</div>