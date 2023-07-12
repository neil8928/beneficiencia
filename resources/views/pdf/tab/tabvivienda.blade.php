<article>
	<div class='titulotab'><b>Vivienda :</b></div>
	<div class="top p-lrxs">
		<h4 class='m-xs colorazul'>Propiedad y Ocupacion de la Vivienda</h4>
	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Tenencia de Vivienda :</strong> {{$tenenciavivienda}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Acredita la propiedad :</strong> {{$acreditepropiedadvivienda}}
				</p>
				<p class="d3 m-xs">
					<strong>N° de Pisos :</strong> {{$ficha->numeropisosvivienda}}
				</p>

	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>N° Ambiente :</strong> {{$ficha->numeroambientevivienda}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Material de las Paredes :</strong> {{$materialparedesvivienda}} 
				</p>
				<p class="d3 m-xs">
					<strong>Material de los Techos :</strong> {{$materialpisosvivienda}}
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Material de los Pisos :</strong> {{$materialtechosvivienda}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Alumbrado Publico :</strong> {{$ficha->alumbradopublicovivienda}} 
				</p>
				<p class="d3 m-xs">

				</p>
	    </div>


	    <h4 class='m-xs colorazul' style="padding-top: 8px;">Accesos a los servicios Clasicos</h4>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Servicio Publico : </strong>{{$serviciopublicostext}}
				</p>  		    	
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Abastecimiento de Agua : </strong>{{$abastecimientoaguatext}}
				</p>  		    	
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Servicios Higienicos : </strong>{{$servicioshigienicostext}}
				</p>  		    	
	    </div>


	    <div class="det2">
				<p class="m-xs">
					<strong>Observacion :</strong> {{$ovivienda}}
				</p>
	    </div>


	</div>
</article>
