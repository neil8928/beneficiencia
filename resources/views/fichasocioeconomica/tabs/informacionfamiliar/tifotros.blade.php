<div id="tifotros" class="tab-pane cont">
	<form name="frmreifotros" id='frmreifotros' action="#">
	    <div class="row">
	    	<div class="col-sm-10">
	     		<div class="be-checkbox inline">
	                 <input type='checkbox'  id='swentrevistadoof' name='swentrevistadoof'  class="form-control control input-xs">
	                  <label for="swentrevistadoof">
	                        <font style="vertical-align: inherit;">
	                              <font   style="vertical-align: inherit;">Entrevistado?</font>
	                        </font>
	                  </label>
	            </div>
			</div>
	        <div class="col-sm-2">
	     		<input type="hidden" name="idregistroof" name="idregistroof" value="">
	     	</div>
		</div>
		
		<div class="row form-inline rowform">
			<div class="col-sm-4">
				<div class="form-group">
				    <label for="txtnombresof"><b>Nombres</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				    <input type="text" class="form-control control input-xs" name="txtnombresof" id='txtnombresof' value="">
				</div>
			</div>
			<div class="col-sm-4">									                            	
				<div class="form-group">
				   	<label for="txtapellidopaternoof"><b>Apell. Paterno</b></label>
					<input type="text" class="form-control control input-xs" name="txtapellidopaternoof" id='txtapellidopaternoof' value="">
				</div>
			</div>
			<div class="col-sm-4">									                            	
				<div class="form-group">
				   	<label for="txtapellidomaternoof"><b>Apell. Materno</b></label>
	        		<input type="text" class="form-control control input-xs" name="txtapellidomaternoof" id='txtapellidomaternoof' value="">
	        	</div>
			</div>
	    </div>

	    <div class="row form-inline rowform">
			<div class="col-sm-4">
				<div class="form-group">
				    <label for="fechanacimientoof"><b>Nacimiento</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				    <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker">
	                          <input size="12" type="text" value="{{date_format(date_create(date('d-m-Y')),'d-m-Y')}}" 
	                          placeholder="Fec. Nacimiento"
	                          id = 'fechanacimientoof' name='fechanacimientoof' 
	                          autocomplete="off"
	                          class="form-control input-xs">
	                          <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
	                </div>
	            </div>
			</div>
			<div class="col-sm-4">									                            	
				<div class="form-group">
				   	<label for="edadof" class="labelleft"><b>Edad</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="number" class="form-control control input-xs controlderecha" name="edadof" id='edadof' min="1" max="150" step="1" value="0">
				</div>
			</div>
			<div class="col-sm-4">									                            	
				<div class="form-group">
				   	<label><b>Sexo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				   	<div class="be-radio has-success inline">
	                  	<input type="radio" class="radiosexoof radio" value='0' checked  name="sexoof" id="rad3">
	                  	<label for="rad3">H</label>
	                </div>
	                <div class="be-radio has-danger inline radio2">
	                  	<input type="radio" class="radiosexoof radio" required = "" value='1' name="sexoof" id="rad4">
	                  	<label for="rad4">M</label>
	                </div>

	        	</div>
			</div>
	    </div>

	    <div class="row form-inline rowform">
			<div class="col-sm-4">
				<div class="form-group">
				    <label for="dniof"><b>N° De DNI</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				    <input type="text" class="form-control control input-xs solonumeros validarnumero" name="dniof" id='dniof' value="">
				</div>
			</div>
			<div class="col-sm-4">									                            	
				<div class="form-group">
				   	<label for="telefonoof" class="labelleft"><b>Telefono</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<input type="text" class="form-control control input-xs controlderecha validarnumero" name="telefonoof" id='telefonoof' value="">
				</div>
			</div>
	    </div>

	    <div class="row form-inline rowform">
			<div class="col-sm-4">
				<div class="form-group">
				    <label for="emailof"><b>Correo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				    <input type="email" class="form-control control input-xs" name="emailof" id='emailof' value="">
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Carga Familiar</label>
	            	<input type="number" 
							class="form-control control input-xs controlderecha" 
							name="cargafamiliarof" id='cargafamiliarof' 
							min="0" max="50" 
							step="1" 
							value="0"
							>
	          	</div>
	        </div>
			<div class="col-sm-4">
				
			</div>
	    </div>

	    <div class="row">
	    	<div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Estado Civil</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'estadocivilof', $comboestadocivilof, array(),
	                        [
	                        	'class'       => 'form-control control input-xs estadocivilof select2' ,
	                            'id'          => 'estadocivilof',
	                            'data-aw'     => '19',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	        <div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Nivel Educativo</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'niveleducativoof', $comboniveleducativoof, array(),
	                        [
	                        	'class'       => 'form-control control input-xs niveleducativoof select2' ,
	                            'id'          => 'niveleducativoof',
	                            'data-aw'     => '20',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

			<div class="col-sm-3">
	          	<div class="form-group ">
	            	<label class="control-label labelleft negrita" >Tipo de Seguro</label>
	            	<div class="abajocaja">
	             	 	{!! Form::select( 'tipodeseguroof', $combotipodeseguroof, array(),
	                        [
	                        	'class'       => 'form-control control input-xs tipodeseguroof select2' ,
	                            'id'          => 'tipodeseguroof',
	                            'data-aw'     => '21',
	                        ]) !!}
	            	</div>
	          	</div>
	        </div>

	        <div class="col-sm-3">
	        	<div class="form-group">
	            	<label class="control-label labelleft negrita" >Parentesco:</label>
	            	<div class="abajocaja">
	         	 		{!! Form::select( 'parentescoof', $comboparentesco, array(),
		                    [
		                    	'class'       => 'form-control control input-sm parentescoof select2' ,
		                        'id'          => 'parentescoof',
		                        'data-aw'     => '18',
		                    ]) !!}
		            </div>
	          	</div>
	        </div>
	    </div>
	    <div class="row rowform">
	    	<div class="col-sm-10">
	    		
	    	</div>
	    	<div class="col-sm-2">
	    		<div class="form-inline divcentroderecha">
	    			
	    			<button type="reset" title="Limpiar" 
	     			class="btn btn-primary botoncabecera btn-lg" 
	     			id='btnlimpiarregtifotros' 
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
    	<div class="ajaxtablaifotros">
			@include('fichasocioeconomica.tabs.informacionfamiliar.ajax.ajaxtinformacionfamiliar', [
	        	'listafamiliares' => $listafamiliares,
	   		])

			{{-- <table id="tinformacionfamiliar" class="table table-striped table-hover table-fw-widget tinformacionfamiliar" name='dtinformacionfamiliar' >
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Edad</th>
						<th>DNI</th>
						<th>Telf.</th>
						<th>Sexo</th>
						<th>Parentesco</th>
						<th>Estado Civil</th>
						<th>Nivel Educativo</th>
						<th>Seguro</th>
						<th>Discapacidad</th>
						<th>Opcion</th>
					</tr>
				</thead>
				<tbody>
					@if(isset($listafamiliares))
						@foreach($listafamiliares as $item)
							<tr>
								<td class="tdifnombre">{{$item->nombre}} </td>
								<td class="tdifedad">{{$item->edad}}</td>
								<td class="tdifdni">{{$item->dni}}</td>
								<td class="tdiftelefono">{{$item->telefono}}</td>
								<td class="tdifedad">{{$item->edad}}</td>
								<td class="tdifparentesco"> {{$item->parentesco_id}}</td>
								<td class="tdifestadocivil">{{$item->estadocivil_id}}</td>
								<td class="tdifniveleducativo">{{$item->niveleducativo_id}}</td>
								<td class="tdifseguro">{{$item->seguro_id}}</td>
								<td class="tdifdiscapacidad">{{$item->discapacidad_id}}</td>
								<td class="tdifopciones"> 	
									<span class="icon mdi mdi-close">Eliminar</span> 
								</td>
							</tr>                    
						@endforeach
					@endif
				</tbody>
			</table> 
			<div class="row">
	           	<button type="button" id='btnocultartif' name='btnocultartif' class="btn btn-space btn-general btnguardarprincipal"> Ocultar Tabla </button>
			</div>
			</div> --}}
    	</div>

</div>