<div id="tpevaluacionprofesional" class="tab-pane cont tpevaluacionprofesional">

    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Diagnostico Social</h3>
  			</div>

            <div class="panel-body">

            	<div class="col-lg-12">
	                <div class="form-group">
	                      <div class="col-sm-12 abajocaja">
	                        <textarea 
	                        	name="diagnosticosocial" 
	                        	id='diagnosticosocial' 
	                        	class="form-control input-xs"
						        rows="3" 
						        cols="50" 
	                        	placeholder="Diagnostico Social">@if(isset($registro)){{ $registro->diagnostico}}@endif</textarea>
	                      </div>
	                </div>
				</div>

            </div>
        </div>
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Conclusiones</h3>
  			</div>

            <div class="panel-body">

            	<div class="col-lg-12">
	                <div class="form-group">
	                      <div class="col-sm-12 abajocaja">
	                        <textarea 
	                        	name="conclusiones" 
	                        	id='conclusiones' 
	                        	class="form-control input-xs"
						        rows="3" 
						        cols="50" 
	                        	placeholder="Conclusiones">@if(isset($registro)){{ $registro->conclusiones}}@endif</textarea>
	                      </div>
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
                    <button type="button" id='btnguardartevalp' name='btnguardartevalp' class="btn btn-space btn-primary btnguardarprincipal" 
                    	data_opcion='{{ $idopcion }}'
                    	data_id='{{ $idregistro }}'
                    	> Guardar </button>
                  </p>
                </div>
              </div>

	</div>



</div>