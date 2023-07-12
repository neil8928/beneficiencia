
<div id="tpbeneficios" class="tab-pane cont tpbeneficios">
    <div class="row">


        <div class="panel panel-default panel-general">
        
	        <div class="panel-heading">
	    			<h3 class="panel-title"><b>Apoyo Social</b></h3>
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


					          </div>
									</div>
									<br>
							    <div class="row">
							    	<div class="col-sm-12">

												    <div class="row rowform">
												    	<div class="col-sm-10">
												    		
												    	</div>
												    	<div class="col-sm-2">
												    		<div class="form-inline divcentroderecha">
												    			
												     			<button type="button" title="Agregar Apoyo Social" 
												     			class="btn btn-success botoncabecera btn-lg" 
												     			id='btnagregarapoyosocial' 
												     			data_id ='{{ $idregistro }}'
												     			data_opcion='{{$idopcion}}'
												     			>
												                	<span class="icon mdi mdi-save"></span>
												          </button>

												     		</div>
												     	</div>
												    </div>


												    <div class="contenedortabla" id='conttablebeneficios'>
												    	<div class="ajaxtablabeneficios">
																@include('fichasocioeconomica.tabs.beneficios.ajax.ajaxtbeneficios', [
														        	'listabeneficios' => $listabeneficios,
														   		])
												    	</div>
														</div>							    		
					          </div>
									</div>


							<div class="col-lg-12">
								<div class="panel-heading panel-heading-divider">
									<b style="font-style: italic;">Observaciones : </b> 
									<span class="mdi mdi-comment-more icoobservacion"
										data_observacion ='{{$obeneficios}}'
										data_ficha='{{ $idregistro }}'
										data_tab='beneficios'
										data_descripcion='Beneficios'
										data_opcion='{{ $idopcion }}'
									></span>
									<span class="panel-subtitle observacion-beneficios">{{$obeneficios}}</span>
								</div>
							</div>


	            </div>
	        	</div>
	        </div>


        </div> 

	</div>
</div>