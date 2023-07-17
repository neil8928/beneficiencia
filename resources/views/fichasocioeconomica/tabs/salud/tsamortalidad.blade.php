<div id="tsamortalidad" class="tab-pane cont tsamortalidad">
	<form name="frmresamortalidad" id='frmresamortalidad' action="#">
	    <div class="row">
	    	<div class="col-sm-12">
				<div class="form-group" style="margin-bottom:0px;">
				    <label for="txtnombresof" ><b>
				    	<small style="font-size: 13px;">(*) Durante el último año, Algún familiar a fallecido por alguna enfermedad?</small>
				    </b></label>
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
	            	<label class="control-label labelleft negrita" >Parentesco con el usuario</label>
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
	          	<div class="form-group " style="display:none;">
	            	<label class="control-label labelleft negrita" >Espeficique</label>
	            	<div class="abajocaja">
						<input type="text" class="form-control control input-sm cadlugarfallecimiento" name="cadlugarfallecimiento" id='cadlugarfallecimiento' value="">

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
          			@if($swmodificar==1)
	     			<button type="button" title="Agregar Otro Registro" 
	     			class="btn btn-success botoncabecera btn-lg" 
	     			id='btnagregarotrofamiliar' 
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
    <div class="contenedortabla" id='conttableinfmortalidad'>
    	<div class="ajaxtablaifotrosmortalidad">

			@if($swmodificar==1)
				@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsaludmortalidad', [
		        	'listafamiliares' => $listafamiliaresmortalidad,
					'swelim'=>true
		   		])
		   	@else
		   		@include('fichasocioeconomica.tabs.salud.ajax.ajaxtsaludmortalidad', [
		        	'listafamiliares' => $listafamiliaresmortalidad
		   		])
		   	@endif

		
    	</div>

</div>