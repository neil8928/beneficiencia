<div id="tpsituacioneconomica" class="tab-pane cont tpsituacioneconomica">
    <div class="row">
        <div class="panel panel-default panel-general">

			<form name="frmactivoseconomicos" id='frmactivoseconomicos' action="#">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Situacion Economica en el Hogar</h3>
  			</div>
            <div class="panel-body" style="padding-bottom: 0px;">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body" >


						    <div class="row">

						    		<div class="col-lg-12">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Activos economicos en el Hogar</label>
						                    <div class="col-sm-12 abajocaja">
		                                        <select multiple="" class="tags" id='bienes' name='bienes[]'>
		                                          @foreach($listabienes as $item)
								                    @php $selected = '';if (in_array($item->id, $bienes)) { $selected = 'selected';} @endphp
		                                            <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
		                                          @endforeach
		                                        </select>
						                      </div>
						                </div>
									</div>
									<br>
									<div class="col-lg-12">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Otros bienes</label>
						                    <div class="col-sm-12 abajocaja">

												<input type="text" class="form-control control input-sm" 
												name="otrosbienes" 
												id='otrosbienes' 
												value="@if(isset($registro)){{$registro->otrosbienes}}@endif">

						                    </div>
						                </div>
									</div>


							</div>


		            </div>
		        </div>
            </div>


       		<div class="panel-heading" style="padding-top: 0px;">
    			<h3 class="panel-title negrita">Situacion Economicas del Usuario</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body" style="padding-bottom: 0px;">
		            		<div class="row">
									<div class="col-lg-4">
							                <div class="form-group">
							                    <label class="col-sm-12 control-label labelleft negrita">Ocupacion Principal :</label>
							                    <div class="col-sm-12 abajocaja">
													<input type="text" class="form-control control input-sm" 
													name="ocupacionprincipalusuario" 
													id='ocupacionprincipalusuario' 
													value="@if(isset($beneficiario)){{$beneficiario->ocupacionprincipalusuario}}@endif">
							                    </div>
							                </div>
									</div>
									<div class="col-lg-4">
							                <div class="form-group">
							                    <label class="col-sm-12 control-label labelleft negrita">Frecuencia de Actividad :</label>
							                    <div class="col-sm-12 abajocaja">
						                      	   	{!! Form::select( 'frecuenciaactividadusuario_id', $combofrecuenciaactividadusuario, array(),
						                                [
						                                  'class'       => 'form-control control input-xs select2' ,
						                                  'id'          => 'frecuenciaactividadusuario_id',
						                                  'required'    => '',
						                                  'data-aw'     => '01'
						                                ]) !!}

							                    </div>
							                </div>
									</div>

									<div class="col-lg-4">
							                <div class="form-group">
							                    <label class="col-sm-12 control-label labelleft negrita">Remuneracion Mensual :</label>
							                    <div class="col-sm-12 abajocaja">
													<input type="number" class="form-control control input-sm" 
													name="remuneracionmensualusuario" 
													id='remuneracionmensualusuario' 
													min="0"
													step="0.01" 
													value="@if(isset($beneficiario)){{$beneficiario->remuneracionmensualusuario}}@else{{0}}@endif">
							                    </div>
							                </div>
									</div>


							</div>



							<div class="row">

								<div class="col-lg-4">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Actividades Extras :</label>
						                    <div class="col-sm-12 abajocaja">
												<input type="text" class="form-control control input-sm" 
												name="actividadesextrasusuario" 
												id='actividadesextrasusuario' 
												value="@if(isset($beneficiario)){{$beneficiario->actividadesextrasusuario}}@endif">
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
				                    	class="btn btn-space btn-primary btnguardarvivienda" 
				                    	data_opcion='{{ $idopcion }}'
				                    	data_id='{{ $idregistro }}'
				                    	> 
				                    	Guardar 
				                	</button>
				                	@endif
				                  </p>
				                </div>
					        </div>


		            </div>
		        </div>


            </div>
			</form>

       		<div class="panel-heading" style="padding-top: 0px;">
    			<h3 class="panel-title negrita">Situacion Economicas Fuera del Hogar</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
						<form name="frmactividadeseconomicasfh" id='frmactividadeseconomicasfh' action="#">
		            		<div class="row">
								<div class="col-sm-4">									                            	
									<div class="form-group" style="margin-bottom:0px;">
										<label class="control-label labelleft negrita" >Nombres</label>
						            	<div class="abajocaja">
											<input type="text" class="form-control control input-sm" name="txtnombrefamiliarfh" id='txtnombrefamiliarfh' value="">
						            	</div>
									</div>
								</div>
								<div class="col-lg-4">
						                <div class="form-group" style="margin-bottom:0px;">
						                    <label class="col-sm-12 control-label labelleft negrita">Ocupacion Principal :</label>
						                    <div class="col-sm-12 abajocaja">
												<input type="text" class="form-control control input-sm" 
												name="ocupacionprincipalfh" 
												id='ocupacionprincipalfh' 
												value="">
						                    </div>
						                </div>
								</div>
						    	<div class="col-sm-4">
						          	<div class="form-group " style="margin-bottom:0px;">
						            	<label class="control-label labelleft negrita" >Parentesco</label>
						            	<div class="abajocaja">
						             	 	{!! Form::select( 'parentesfh', $comboparentesco, array(),
						                        [
						                        	'class'       => 'form-control control input-sm  select2' ,
						                            'id'          => 'parentesfh',
						                            'data-aw'     => '19',
						                        ]) !!}
						            	</div>
						          	</div>
						        </div>



							</div>

							<div class="row">
								<div class="col-sm-4">
						                <div class="form-group">
						                    <label class="control-label labelleft negrita">Remuneracion de apoyo :</label>
						                    <div class="abajocaja">
												<input type="number" class="form-control control input-sm" 
												name="remuneracionmensualfh" 
												id='remuneracionmensualfh' 
												min="0"
												step="0.01" 
												value="0">
						                    </div>
						                </div>
								</div>

								<div class="col-sm-8">
									<div class="row filavaciabotones">
										<div class="col-lg-9">
										</div>
										<div class="col-lg-3">
								        	<div class="form-inline divcentroderecha" style="    margin-top: 21px;"	>
								    			

												@if($swmodificar==1)
								     			<button type="button" title="Agregar Otro Registro" 
								     			class="btn btn-success botoncabecera btn-lg" 
								     			id='btnagregarotrofamiliarfh' 
								     			data_id ='{{ $idregistro }}'
								     			data_opcion='{{$idopcion}}'
								     			>
								                	<span class="icon mdi mdi-save"></span>
								              	</button> &nbsp;
								              	@endif
								     		</div>
								        </div>
									</div>
								</div>
							</div>

							<div class="contenedortabla" id='conttableinffam'>
						    	<div class="ajaxtablaifsituacioneconomicafh">
						    		@if($swmodificar==1)
										@include('fichasocioeconomica.tabs.situacioneconomica.ajax.ajaxtsituacioneconomicafh', [
								        	'listafamiliares' => $listaactividadeseconomicasfh,
								        	'swelim'=>true
								   		])
								   	@else
									   	@include('fichasocioeconomica.tabs.situacioneconomica.ajax.ajaxtsituacioneconomicafh', [
									        	'listafamiliares' => $listaactividadeseconomicasfh,
									   		])
								   	@endif
						    	</div>
							</div>
						</form>
		            </div>
		        </div>


            </div>



       		<div class="panel-heading" style="padding-top: 0px;">
    			<h3 class="panel-title negrita">Situacion Economicas de la Familia</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
						<form name="frmactividadeseconomicas" id='frmactividadeseconomicas' action="#">

		            		<div class="row">
				            	<div class="col-lg-3">
					               <div class="be-checkbox inline" style="    margin-left: 15px;">
						                <input type='checkbox'  id='swjefefamilia' name='swjefefamilia'  class="form-control control input-lg">


					                  	<label for="swjefefamilia">
					                        <font style="vertical-align: inherit;">
					                              <font   style="vertical-align: inherit;"><b>Jefe de Familia?</b></font>
					                        </font>
					                  	</label>
					            	</div>
								</div>
							</div>

		            		<div class="row">

					            	<div class="col-lg-4">
						                <div class="form-group ajaxfamiliarse">
	          								@include('fichasocioeconomica.ajax.cfamiliase')

						                </div>
									</div>
									<div class="col-lg-4">
							                <div class="form-group">
							                    <label class="col-sm-12 control-label labelleft negrita">Ocupacion Principal :</label>
							                    <div class="col-sm-12 abajocaja">
													<input type="text" class="form-control control input-sm" 
													name="ocupacionprincipal" 
													id='ocupacionprincipal' 
													value="">
							                    </div>
							                </div>
									</div>
									<div class="col-lg-4">
							                <div class="form-group">
							                    <label class="col-sm-12 control-label labelleft negrita">Frecuencia de Actividad :</label>
							                    <div class="col-sm-12 abajocaja">
						                      	   	{!! Form::select( 'frecuenciaactividad', $combofrecuenciaactividad, array(),
						                                [
						                                  'class'       => 'form-control control input-xs select2' ,
						                                  'id'          => 'frecuenciaactividad',
						                                  'required'    => '',
						                                  'data-aw'     => '01'
						                                ]) !!}

							                    </div>
							                </div>
									</div>



							</div>

							<div class="row">
								<div class="col-lg-4">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Remuneracion Mensual :</label>
						                    <div class="col-sm-12 abajocaja">
												<input type="number" class="form-control control input-sm" 
												name="remuneracionmensual" 
												id='remuneracionmensual' 
												min="0"
												step="0.01" 
												value="0">
						                    </div>
						                </div>
								</div>
								<div class="col-lg-4">
						                <div class="form-group">
						                    <label class="col-sm-12 control-label labelleft negrita">Actividades Extras :</label>
						                    <div class="col-sm-12 abajocaja">
												<input type="text" class="form-control control input-sm" 
												name="actividadesextras" 
												id='actividadesextras' 
												value="">
						                    </div>
						                </div>
								</div>
							</div>


							<div class="row filavaciabotones">
								<div class="col-lg-9">
								</div>
								<div class="col-lg-3">
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

							<div class="contenedortabla" id='conttableinffam'>
						    	<div class="ajaxtablaifsituacioneconomica">
						    		@if($swmodificar==1)
										@include('fichasocioeconomica.tabs.situacioneconomica.ajax.ajaxtsituacioneconomica', [
								        	'listafamiliares' => $listaactividadeseconomicas,
								        	'swelim'=>true
								   		])
								   	@else
									   	@include('fichasocioeconomica.tabs.situacioneconomica.ajax.ajaxtsituacioneconomica', [
									        	'listafamiliares' => $listaactividadeseconomicas,
									   		])
								   	@endif
						    	</div>
							</div>
						</form>
		            </div>
		        </div>

				<div class="col-lg-12">
					<div class="panel-heading panel-heading-divider">
						<b style="font-style: italic;">Observaciones : </b> 
						@if($swmodificar==1)
						<span class="mdi mdi-comment-more icoobservacion"
							data_observacion ='{{$osituacioneconomica}}'
							data_ficha='{{ $idregistro }}'
							data_tab='situacioneconomica'
							data_descripcion='Situacion Economica'
							data_opcion='{{ $idopcion }}'
						></span>
						@endif
						<span class="panel-subtitle observacion-situacioneconomica">{{$osituacioneconomica}}</span>
					</div>
				</div>
            </div>





        </div> 


        


	</div>
</div>