
<div id="tpconvivenciafamiliar" class="tab-pane cont tpconvivenciafamiliar">
    <div class="row">


        <div class="panel panel-default panel-general">
        
	        <div class="panel-heading">
	    			<h3 class="panel-title">Situación de Violencia en el <b>"Hogar"</b></h3>
	  			</div>
	        <div class="panel-body" style="padding-bottom: 0px;">
	        	<div class="panel panel-default panel-general">
	        		<div class="panel-body">
							    <div class="row">
							    	<div class="col-sm-12">
							            	<div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Tipo de violencia en el hogar:</label>
								                    <div class="col-sm-12 abajocaja">
				                                        <select multiple="" class="selectxs" id='tipoviolenciageneral' name='tipoviolenciageneral[]'>
				                                          @foreach($listatipoviolenciageneral as $item)
										                    						@php $selected = '';if (in_array($item->id, $tipoviolenciageneral)) { $selected = 'selected';} @endphp
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
	        </div>

	       	<div class="panel-heading" style="padding-top: 0px;padding-bottom: 0px;">
	    			<h3 class="panel-title">Situación de Violencia en los <b>"Hijos"</b></h3>
	  			</div>
	        <div class="panel-body">
	        	<div class="panel panel-default panel-general">
	        		<div class="panel-body">

						    <div class="row">
						    	<div class="col-sm-12">
				            	<div class="col-lg-4">
					                <div class="form-group">
					                    <label class="col-sm-12 control-label labelleft negrita">Tipo de violencia en los Hijos:</label>
					                    <div class="col-sm-12 abajocaja">
		                                      <select multiple="" class="selectxs" id='tipoviolenciahijo' name='tipoviolenciahijo[]'>
		                                        @foreach($listatipoviolenciahijo as $item)
							                    	@php $selected = '';if (in_array($item->id, $tipoviolenciahijo)) { $selected = 'selected';} @endphp
		                                          <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
		                                        @endforeach
		                                      </select>
					                      </div>
					                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe Abandono en los hijos:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfhabandono" 
					    													id='cfhabandono'
					    													placeholder="Especificar" 
					    													value="@if(isset($registro)){{$registro->cfhabandono}}@endif">
								                    </div>
								                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Reciben Pension los hijos:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfhpensionalimenticia" 
					    													id='cfhpensionalimenticia'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfhpensionalimenticia}}@endif">
								                    </div>
								                </div>
											</div>
				        	</div>
				        </div>
						    <div class="row">
						    	<div class="col-sm-12">

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe denuncia de pension:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfhdenunciapension" 
					    													id='cfhdenunciapension'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfhdenunciapension}}@endif">
								                    </div>
								                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe denuncia de matrato:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfhdenunciamaltrato" 
					    													id='cfhdenunciamaltrato'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfhdenunciamaltrato}}@endif">
								                    </div>
								                </div>
											</div>

				            	<div class="col-lg-4">
					                <div class="form-group">
					                    <label class="col-sm-12 control-label labelleft negrita">A que institucion acudio:</label>
					                    <div class="col-sm-12 abajocaja">
		                                      <select multiple="" class="selectxs" id='institucionhijo' name='institucionhijo[]'>
		                                        @foreach($listainstitucionhijo as $item)
							                    						@php $selected = '';if (in_array($item->id, $institucionhijo)) { $selected = 'selected';} @endphp
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
	        </div>


	       	<div class="panel-heading" style="padding-top: 0px;padding-bottom: 0px;">
	    			<h3 class="panel-title">Situación de Violencia en los <b>"Adultos Mayores"</b></h3>
	  			</div>
	        <div class="panel-body">
	        	<div class="panel panel-default panel-general">
	        		<div class="panel-body">

						    <div class="row">
						    	<div class="col-sm-12">
				            	<div class="col-lg-4">
					                <div class="form-group">
					                    <label class="col-sm-12 control-label labelleft negrita">Tipo de violencia en los Adultos:</label>
					                    <div class="col-sm-12 abajocaja">
		                                      <select multiple="" class="tags form-control select3" id='tipoviolenciaabuelo' name='tipoviolenciaabuelo[]'>
		                                        @foreach($listatipoviolenciaabuelo as $item)
							                    						@php $selected = '';if (in_array($item->id, $tipoviolenciaabuelo)) { $selected = 'selected';} @endphp
		                                          <option value='{{$item->id}}' {{$selected}}>{{$item->nombre}}</option>
		                                        @endforeach
		                                      </select>
					                      </div>
					                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe Abandono en los Adultos:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfamabandono" 
					    													id='cfamabandono'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfamabandono}}@endif">
								                    </div>
								                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Reciben Pension los Adultos:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfampensionalimenticia" 
					    													id='cfampensionalimenticia'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfampensionalimenticia}}@endif">
								                    </div>
								                </div>
											</div>
				        	</div>
				        </div>
						    <div class="row">
						    	<div class="col-sm-12">

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe denuncia de pension:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfamdenunciapension" 
					    													id='cfamdenunciapension'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfamdenunciapension}}@endif">
								                    </div>
								                </div>
											</div>

							        <div class="col-lg-4">
								                <div class="form-group">
								                    <label class="col-sm-12 control-label labelleft negrita">Existe denuncia de matrato:</label>
								                    <div class="col-sm-12 abajocaja">
					    													<input type="text" 
					    													class="form-control control input-md" 
					    													name="cfamdenunciamaltrato" 
					    													id='cfamdenunciamaltrato'
					    													placeholder="Especificar"
					    													value="@if(isset($registro)){{$registro->cfamdenunciamaltrato}}@endif">
								                    </div>
								                </div>
											</div>

				            	<div class="col-lg-4">
					                <div class="form-group">
					                    <label class="col-sm-12 control-label labelleft negrita">A que institucion acudio:</label>
					                    <div class="col-sm-12 abajocaja">
		                                      <select multiple="" class="selectxs" id='institucionabuelo' name='institucionabuelo[]'>
		                                        @foreach($listainstitucionabuelo as $item)
							                    						@php $selected = '';if (in_array($item->id, $institucionabuelo)) { $selected = 'selected';} @endphp
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
										data_observacion ='{{$oconvivenciafamiliar}}'
										data_ficha='{{ $idregistro }}'
										data_tab='convivenciafamiliar'
										data_descripcion='Convivencia Familiar'
										data_opcion='{{ $idopcion }}'
									></span>
									<span class="panel-subtitle observacion-convivenciafamiliar">{{$oconvivenciafamiliar}}'</span>
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
                    	class="btn btn-space btn-primary btnguardarconvivenciafamiliar" 
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