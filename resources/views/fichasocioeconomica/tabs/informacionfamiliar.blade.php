<div id="tpinformacionfamiliar" class="tab-pane cont tpinformacionfamiliar">
    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Información Social de la Familia 						
    					<span class="mdi mdi-accounts-alt icoclonar"
							data_ficha='{{ $idregistro }}'
							data_opcion='{{ $idopcion }}'
						></span>
				</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
		            	<div class="tab-container sinmargenbajo">
		                    <ul class="nav nav-tabs">
		                        <li class="active"><a href="#tifbeneficiario" data-toggle="tab">Usuario</a></li>
		                        <li><a href="#tifotros" data-toggle="tab"> Otros</a></li>
		                    </ul>
		                    <div class="tab-content" style="margin-bottom: 0px;">
		                        @include('fichasocioeconomica.tabs.informacionfamiliar.tifbeneficiario')
		                        @include('fichasocioeconomica.tabs.informacionfamiliar.tifotros')

		                    </div>

							<div class="col-lg-12">
								<div class="panel-heading panel-heading-divider">
									<b style="font-style: italic;">Observaciones : </b> 
									<span class="mdi mdi-comment-more icoobservacion"
										data_observacion ='{{$oinformacionfamiliar}}'
										data_ficha='{{ $idregistro }}'
										data_tab='informacionfamiliar'
										data_descripcion='Informacion Familiar'
										data_opcion='{{ $idopcion }}'
									></span>
									<span class="panel-subtitle observacion-informacionfamiliar">{{$oinformacionfamiliar}}'</span>
								</div>
							</div>


		                </div>
		            </div>
		        </div>
            </div>
        </div>     
	</div>
</div>