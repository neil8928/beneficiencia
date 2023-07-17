
<div id="tpbeneficios" class="tab-pane cont tpbeneficios">
    <div class="row">


        <div class="panel panel-default panel-general">
        
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Programa beneficiario del Usuario</h3>
  			</div>
            <div class="panel-body" style="padding-bottom: 0px;">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body" style="padding-bottom: 0px;">
				    	<form name="frmbeneficiousuario" id='frmbeneficiousuario' action="#">
						    <div class="row">
						    		<div class="col-lg-12">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Programa beneficiario</label>
						                    <div class="col-sm-12 abajocaja">
		                                        <select multiple="" class="tags" id='bienesusuario' name='bienesusuario[]'>
		                                          @foreach($listaprogramabeneficiario as $item)
								                    @php $selected = '';if (in_array($item->id, $programausuario)) { $selected = 'selected';} @endphp
		                                            <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
		                                          @endforeach
		                                        </select>
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
				                  	@if($swmodificar==1)
				                    <button type="button" 
				                    	id='btnguardartdg' 
				                    	name='btnguardartdg' 
				                    	class="btn btn-space btn-primary btnbeneficiousuario" 
				                    	data_opcion='{{ $idopcion }}'
				                    	data_id='{{ $idregistro }}'
				                    	> 
				                    	Guardar 
				                	</button>
				                	@endif
				                  </p>
				                </div>
					        </div>
				 		</form>
		            </div>
		        </div>
            </div>




	        <div class="panel-heading" style="padding-top: 0px;">
	    			<h3 class="panel-title"><b>Programa beneficiario de la Familia</b></h3>
	  			</div>
	        <div class="panel-body" style="padding-bottom: 0px;">
	        	<div class="panel panel-default panel-general">
	        		<div class="panel-body">
	        				<br>
							    <div class="row">
							    	<div class="col-sm-12">

							            	<div class="col-lg-4">
								                <div class="form-group ajaxfamiliarapoyo">
								                	@include('fichasocioeconomica.ajax.cfamiliaapoyo')
								                </div>
											</div>

							            	<div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Programa beneficiario:</label>
								                    <div class="col-sm-12 abajocaja">
							                      	   	{!! Form::select( 'programabeneficiario_id', $comboprogramabeneficiario, array(),
							                                [
							                                  'class'       => 'form-control control input-xs select2' ,
							                                  'id'          => 'programabeneficiario_id',
							                                  'required'    => '',
							                                  'data-aw'     => '01'
							                                ]) !!}

								                      </div>
								                </div>
											</div>

							            	<div class="col-lg-4">
									    		<div class="form-inline divcentroderecha" style="    margin-top: 21px;">
  														@if($swmodificar==1)
										     			<button type="button" title="Agregar Apoyo Social" 
										     			class="btn btn-success botoncabecera btn-lg" 
										     			id='btnagregarapoyosocial' 
										     			data_id ='{{ $idregistro }}'
										     			data_opcion='{{$idopcion}}'
										     			>
										                	<span class="icon mdi mdi-save"></span>
										          		</button>
										          		@endif
										     	</div>
											</div>
					          </div>
									</div>
									<br>
							    <div class="row">
							    	<div class="col-sm-12">
												    <div class="contenedortabla" id='conttablebeneficios'>
												    	<div class="ajaxtablabeneficios">
															@if($swmodificar==1)
																@include('fichasocioeconomica.tabs.beneficios.ajax.ajaxtbeneficios', [
														        	'listabeneficios' => $listabeneficios,
														        	'swelim'=>true,
														   		])
														   	@else
														   		@include('fichasocioeconomica.tabs.beneficios.ajax.ajaxtbeneficios', [
														        	'listabeneficios' => $listabeneficios,
														   		])
														   	@endif
												    	</div>
														</div>							    		
					          		</div>
								</div>


							<div class="col-lg-12">
								<div class="panel-heading panel-heading-divider">
									<b style="font-style: italic;">Observaciones : </b> 
          							@if($swmodificar==1)
									<span class="mdi mdi-comment-more icoobservacion"
										data_observacion ='{{$obeneficios}}'
										data_ficha='{{ $idregistro }}'
										data_tab='beneficios'
										data_descripcion='Beneficios'
										data_opcion='{{ $idopcion }}'
									></span>
									@endif
									<span class="panel-subtitle observacion-beneficios">{{$obeneficios}}</span>
								</div>
							</div>


	            </div>
	        	</div>
	        </div>


        </div> 

	</div>
</div>