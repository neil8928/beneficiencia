<div id="tpsalud" class="tab-pane cont tpsalud">
    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Enfermedades Recientes y Mortalidad</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
		            	<div class="tab-container sinmargenbajo">
		                    <ul class="nav nav-tabs">
		                        <li class="active"><a href="#tsabeneficiario" data-toggle="tab">Usuario</a></li>
		                        <li><a href="#tsaotros" data-toggle="tab"> Otros</a></li>
		                        <li><a href="#tsamortalidad" data-toggle="tab"> Mortalidad</a></li>
		                    </ul>
		                    <div class="tab-content" style="margin-bottom: 0px;">
		                        @include('fichasocioeconomica.tabs.salud.tsabeneficiario')
		                        @include('fichasocioeconomica.tabs.salud.tsaotros')
		                        @include('fichasocioeconomica.tabs.salud.tsamortalidad')

		                    </div>
							<div class="col-lg-12">
								<div class="panel-heading panel-heading-divider">
									<b style="font-style: italic;">Observaciones : </b> 
          							@if($swmodificar==1)
									<span class="mdi mdi-comment-more icoobservacion"
										data_observacion ='{{$osalud}}'
										data_ficha='{{ $idregistro }}'
										data_tab='salud'
										data_descripcion='Salud'
										data_opcion='{{ $idopcion }}'
									></span>
									@endif
									<span class="panel-subtitle observacion-salud">{{$osalud}}</span>
								</div>
							</div>
		                </div>
		            </div>
		        </div>
            </div>
        </div>     
	</div>
</div>