<div id="tpsalud" class="tab-pane active cont tpsalud">
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
		                    <div class="tab-content">
		                        @include('fichasocioeconomica.tabs.salud.tsabeneficiario')
		                        @include('fichasocioeconomica.tabs.salud.tsaotros')
		                        @include('fichasocioeconomica.tabs.salud.tsamortalidad')

		                    </div>
		                </div>
		            </div>
		        </div>
            </div>
        </div>     
	</div>
</div>