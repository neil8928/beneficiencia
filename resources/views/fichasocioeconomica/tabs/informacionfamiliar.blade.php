<div id="tpinformacionfamiliar" class="tab-pane cont tpinformacionfamiliar">
    <div class="row">
        <div class="panel panel-default panel-general">
        	<div class="panel-heading">
    			<h3 class="panel-title negrita">Información Social de la Familia</h3>
  			</div>
            <div class="panel-body">
            	<div class="panel panel-default panel-general">
            		<div class="panel-body">
		            	<div class="tab-container sinmargenbajo">
		                    <ul class="nav nav-tabs">
		                        <li class="active"><a href="#tifbeneficiario" data-toggle="tab">Usuario</a></li>
		                        <li><a href="#tifotros" data-toggle="tab"> Otros</a></li>
		                    </ul>
		                    <div class="tab-content">
		                        @include('fichasocioeconomica.tabs.informacionfamiliar.tifbeneficiario')
		                        @include('fichasocioeconomica.tabs.informacionfamiliar.tifotros')

		                    </div>
		                </div>
		            </div>
		        </div>
            </div>
        </div>     
	</div>
</div>