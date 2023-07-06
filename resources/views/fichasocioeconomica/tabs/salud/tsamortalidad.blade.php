<div id="tsamortalidad" class="tab-pane cont tsamortalidad">
	<form name="frmresamortalidad" id='frmresamortalidad' action="#">
	    <div class="row">
	    	<div class="col-sm-12">
				<div class="form-group">
				    <label for="txtnombresof"><b><h3>Durante el último año, Algún familiar a fallecido por alguna enfermedad?</h3></b></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">									                            	
				<div class="form-group">
					<label class="control-label labelleft negrita" >Nombres</label>
	            	<div class="abajocaja">
						<input type="text" class="form-control control input-xs" name="txtnombrefamiliar" id='txtnombrefamiliar' value="">
	            	</div>
				</div>
			</div>
			<div class="col-sm-6">									                            	
				<div class="form-group">
					<label class="control-label labelleft negrita" >Enfermedad de deceso</label>
	            	<div class="abajocaja">
						<input type="text" class="form-control control input-xs" name="txtenfermedad" id='txtenfermedad' value="">
	            	</div>
				</div>
			</div>
	    </div>

	  
	    <div class="row">
	    	<div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Parentesco con el beneficiario</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'parentescomo', $comboparentesco, array(),
	                        [
	                        	'class'       => 'form-control control input-xs estadocivilof select2' ,
	                            'id'          => 'parentescomo',
	                            'data-aw'     => '19',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	        <div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Lugar de Fallecimiento</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'lugarfallecimiento', $combolugarfallecimientomo, array(),
	                        [
	                        	'class'       => 'form-control control input-xs niveleducativoof select2' ,
	                            'id'          => 'lugarfallecimiento',
	                            'data-aw'     => '20',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

			<div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Espeficique</label>
	            	<div class="abajocaja">
						<input type="text" class="form-control control input-xs cadlugarfallecimiento" name="cadlugarfallecimiento" id='cadlugarfallecimiento' value="">

	            	</div>
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
	     			<button type="button" title="Agregar Otro Registro" 
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
    <div class="contenedortabla" id='conttableinfmortalidad'>
    	<div class="ajaxtablaifotrosmortalidad">
			@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsaludmortalidad', [
	        	'listafamiliares' => $listafamiliaresmortalidad,
	   		])

		
    	</div>

</div>