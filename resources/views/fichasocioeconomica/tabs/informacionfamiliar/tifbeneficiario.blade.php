<div id="tifbeneficiario" class="tab-pane active cont">
    <div class="row">
    	<div class="col-sm-12">
     		<div class="be-checkbox inline">
                  <input type='checkbox'  id='swentrevistado' name='swentrevistado'  class="form-control control input-xs" 
                  	@if(isset($beneficiario)) 
                  		@if($beneficiario->swentrevistado==1)
                  			checked
                  		@endif
                  	@else
                  		
                  	@endif
                  >


                  <label for="swentrevistado">
                        <font style="vertical-align: inherit;">
                              <font   style="vertical-align: inherit;">Entrevistado?</font>
                        </font>
                  </label>
            </div>

		</div>

	</div>
	
	<div class="row form-inline rowform">
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="txtnombres"><b>Nombres</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			    <input type="text" class="form-control control input-xs" name="txtnombres" id='txtnombres' value="@if(isset($beneficiario)) {{ $beneficiario->nombres }} @endif">
			</div>
		</div>
		<div class="col-sm-4">									                            	
			<div class="form-group">
			   	<label for="txtapellidopaterno"><b>Apell. Paterno</b></label>
				<input type="text" class="form-control control input-xs" name="txtapellidopaterno" id='txtapellidopaterno' value="@if(isset($beneficiario)) {{ $beneficiario->apellidopaterno }} @endif">
			</div>
		</div>
		<div class="col-sm-4">									                            	
			<div class="form-group">
			   	<label for="txtapellidomaterno"><b>Apell. Materno</b></label>
        		<input type="text" class="form-control control input-xs" name="txtapellidomaterno" id='txtapellidomaterno' value="@if(isset($beneficiario)) {{ $beneficiario->apellidomaterno }} @endif">
        	</div>
		</div>
    </div>

    <div class="row form-inline rowform">
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="fechanacimiento"><b>Nacimiento</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			    {{-- <input type="date" class="form-control control input-xs" name="fechanacimiento" id='fechanacimiento' value="@if(isset($beneficiario)) {{$beneficiario->fechanacimiento}} @endif"> --}}
			  
			    <div data-min-view="2" data-date-format="dd-mm-yyyy"  class="input-group date datetimepicker">
                          <input size="12" type="text" value="@if(isset($beneficiario)){{old('fechanacimiento',date_format(date_create($beneficiario->fechanacimiento),'d-m-Y'))}}@else{{date_format(date_create(date('d-m-Y')),'d-m-Y')}}@endif" 
                          placeholder="Fec. Nacimiento"
                          id = 'fechanacimiento' name='fechanacimiento' 
                          autocomplete="off"
                          class="form-control input-xs">
                          <span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                </div>
              



			</div>
		</div>
		<div class="col-sm-4">									                            	
			<div class="form-group">
			   	<label for="edad" class="labelleft"><b>Edad</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input type="number" class="form-control control input-xs controlderecha" name="edad" id='edad' min="1" max="150" step="1" value="@if(isset($beneficiario)){{$beneficiario->edad}}@else{{ 0 }}@endif">
			</div>
		</div>
		<div class="col-sm-4">									                            	
			<div class="form-group">
			   	<label><b>Sexo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			   	<div class="be-radio has-success inline">
                  	<input type="radio" class="radiosexo radio" value='0' 
                  		@if(isset($beneficiario)) 
                  			@if($beneficiario->sexo == 0) 
                  				checked  
                  			@endif 
                  		@else 
                  			checked 
                  		@endif 
                  		name="sexo" id="rad1">
                  	<label for="rad1">H</label>
                </div>
                <div class="be-radio has-danger inline radio2">
                  	<input type="radio" class="radiosexo radio" required = "" value='1' @if(isset($beneficiario)) @if($beneficiario->sexo == 1) checked  @endif @endif name="sexo" id="rad2">
                  	<label for="rad2">M</label>
                </div>

        	</div>
		</div>
    </div>

    <div class="row form-inline rowform">
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="dni"><b>N° De DNI</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			    <input type="text" class="form-control control input-xs solonumeros validarnumero" name="dni" id='dni' maxlength="12" value="@if(isset($beneficiario)) {{ $beneficiario->dni }} @endif">
			</div>
		</div>
		<div class="col-sm-4">									                            	
			<div class="form-group">
			   	<label for="telefono" class="labelleft"><b>Telefono</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input type="text" class="form-control control input-xs controlderecha validarnumero" name="telefono" maxlength="20" id='telefono' value="@if(isset($beneficiario)) {{ $beneficiario->telefono }} @endif">
			</div>
		</div>
    </div>

    <div class="row form-inline rowform">
		<div class="col-sm-4">
			<div class="form-group">
			    <label for="email"><b>Correo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			    <input type="email" class="form-control control input-xs" name="email" id='email' value="@if(isset($beneficiario)) {{ $beneficiario->email }} @endif">
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group ">
            	<label class="control-label labelleft negrita" >Carga Familiar</label>
        		<input type="number" 
					class="form-control control input-xs controlderecha" 
					name="cargafamiliar" id='cargafamiliar' 
					min="0" max="50" 
					step="1" 
					value="@if(isset($beneficiario)){{$beneficiario->cargafamiliar}}@else{{ 0 }}@endif"
					>
          	</div>
		</div>
    </div>

    <div class="row rowform">
    	<div class="col-sm-3">
          	<div class="form-group ">
            	<label class="control-label labelleft negrita" >Estado Civil</label>
            	<div class="abajocaja">
             	 	{!! Form::select( 'estadocivil', $comboestadocivil, array(),
                        [
                        	'class'       => 'form-control control input-xs estadocivil select2' ,
                            'id'          => 'estadocivil',
                            'data-aw'     => '14',
                        ]) !!}
            	</div>
          	</div>
        </div>

        <div class="col-sm-3">
          	<div class="form-group ">
            	<label class="control-label labelleft negrita" >Nivel Educativo</label>
            	<div class="abajocaja">
             	 	{!! Form::select( 'niveleducativo', $comboniveleducativo, array(),
                        [
                        	'class'       => 'form-control control input-xs niveleducativo select2' ,
                            'id'          => 'niveleducativo',
                            'data-aw'     => '15',
                        ]) !!}
            	</div>
          	</div>
        </div>

		<div class="col-sm-3">
          	<div class="form-group ">
            	<label class="control-label labelleft negrita" >Tipo de Seguro</label>
            	<div class="abajocaja">
             	 	{!! Form::select( 'tipodeseguro', $combotipodeseguro, array(),
                        [
                        	'class'       => 'form-control control input-xs tipodeseguro select2' ,
                            'id'          => 'tipodeseguro',
                            'data-aw'     => '16',
                        ]) !!}
            	</div>
          	</div>
        </div>

        <div class="col-sm-3">
          	<div class="form-inline divcentroderecha abajo20">
          		@if($swmodificar==1)
     			<button type="button" title="Agregar Beneficiario" 
     			class="btn btn-success botoncabecera btn-lg" 
     			id='btnagregarbeneficiario' 
     			data_id =	'{{ $idregistro }}'
     			data_opcion='{{$idopcion}}'
     			>
     				GUARDAR
                	<span class="icon mdi mdi-save"></span>
              	</button>
              	@endif
     		</div>
        </div>
    </div>
    
    
    
</div>