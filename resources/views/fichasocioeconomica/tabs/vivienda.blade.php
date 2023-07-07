<div id="tpvivienda" class="tab-pane cont tpvivienda">
    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Propiedad y Ocupacion de la Vivienda</h3>
  			</div>
            <div class="panel-body" style="padding-bottom: 0px;">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
				    <div class="row">
				    	<div class="col-sm-12">
			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Tenencia de Vivienda:</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'tenenciavivienda_id', $combotenenciavivienda, array(),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'tenenciavivienda_id',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>


			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Acreditar de la propiedad :</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'acreditepropiedadvivienda_id', $comboacreditepropiedadvivienda, array(),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'acreditepropiedadvivienda_id',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>

			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">N° de Pisos :</label>
				                    <div class="col-sm-12 abajocaja">
										<input type="number" class="form-control control input-xs" 
										name="numeropisosvivienda" 
										id='numeropisosvivienda' 
										min="1" 
										max="150" 
										step="1" 
										value="@if(isset($registro)){{$registro->numeropisosvivienda}}@else{{ 0 }}@endif">
				                      </div>
				                </div>
							</div>


					        <div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">N° Ambiente :</label>
				                    <div class="col-sm-12 abajocaja">
										<input type="number" class="form-control control input-xs" 
										name="numeroambientevivienda" 
										id='numeroambientevivienda' 
										min="1" 
										max="150" 
										step="1" 
										value="@if(isset($registro)){{$registro->numeroambientevivienda}}@else{{ 0 }}@endif">
				                      </div>
				                </div>
							</div>
		                </div>
					</div>
				    <div class="row">
				    	<div class="col-sm-12">

			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Material de las Paredes :</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'materialparedesvivienda_id', $combomaterialparedesvivienda, array(),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'materialparedesvivienda_id',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>

			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Material de los Techos :</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'materialtechosvivienda_id', $combomaterialtechosvivienda, array(),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'materialtechosvivienda_id',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>


			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Material de los Pisos :</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'materialpisosvivienda_id', $combomaterialpisosvivienda, array(),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'materialpisosvivienda_id',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>

			            	<div class="col-lg-3">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Alumbrado Publico :</label>
				                    <div class="col-sm-12 abajocaja">
			                      	   	{!! Form::select( 'alumbradopublicovivienda', $comboalumbradopublicovivienda, array($registro->alumbradopublicovivienda),
			                                [
			                                  'class'       => 'form-control control input-xs select2' ,
			                                  'id'          => 'alumbradopublicovivienda',
			                                  'required'    => '',
			                                  'data-aw'     => '01'
			                                ]) !!}

				                      </div>
				                </div>
							</div>



		                </div>
					</div>
		            </div>
		        </div>
            </div>


       	<div class="panel-heading" style="padding-top: 0px;">
    			<h3 class="panel-title negrita">Accesos a los servicios Clasicos</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">

				    <div class="row">
				    	<div class="col-sm-12">

			            	<div class="col-lg-4">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Servicio Publico:</label>
				                    <div class="col-sm-12 abajocaja">
                                        <select multiple="" class="tags" id='serviciopublicos' name='serviciopublicos[]'>
                                          @foreach($listaserviciopublicos as $item)
						                    @php $selected = '';if (in_array($item->id, $serviciopublicos)) { $selected = 'selected';} @endphp
                                            <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
                                          @endforeach
                                        </select>
				                      </div>
				                </div>
							</div>


			            	<div class="col-lg-4">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Abastecimiento de Agua:</label>
				                    <div class="col-sm-12 abajocaja">
                                        <select multiple="" class="tags" id='abastecimientoagua' name='abastecimientoagua[]'>
                                          @foreach($listaabastecimientoagua as $item)
                                          	@php $selected = '';if (in_array($item->id, $abastecimientoagua)) { $selected = 'selected';} @endphp
                                            <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
                                          @endforeach
                                        </select>
				                      </div>
				                </div>
							</div>
			            	<div class="col-lg-4">
				                <div class="form-group">
				                    <label class="col-sm-12 control-label labelleft negrita">Servicios Higienicos:</label>
				                    <div class="col-sm-12 abajocaja">
                                        <select multiple="" class="tags" id='servicioshigienicos' name='servicioshigienicos[]'>
                                          @foreach($listaservicioshigienicos as $item)
                                          @php $selected = '';if (in_array($item->id, $servicioshigienicos)) { $selected = 'selected';} @endphp
                                            <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
                                          @endforeach
                                        </select>
				                      </div>
				                </div>
							</div>

		                </div>
					</div>

		            </div>
		        </div>


							<div class="col-lg-12">
								<div class="panel-heading panel-heading-divider">
									<b style="font-style: italic;">Observaciones : </b> 
									<span class="mdi mdi-comment-more icoobservacion"
										data_observacion ='{{$ovivienda}}'
										data_ficha='{{ $idregistro }}'
										data_tab='vivienda'
										data_descripcion='Vivienda'
										data_opcion='{{ $idopcion }}'
									></span>
									<span class="panel-subtitle observacion-vivienda">{{$ovivienda}}</span>
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
                    	class="btn btn-space btn-primary btnguardarvivienda" 
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