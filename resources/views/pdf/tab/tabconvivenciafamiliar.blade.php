<article>
	<div class='titulotab'><b>Convivencia Familiar :</b></div>
	<div class="top p-lrxs">

		<h4 class='m-xs colorazul'>Situación de Violencia en el "Hogar"</h4>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Tipo de violencia en el hogar : </strong>{{$tipoviolenciageneraltext}}
				</p>  		    	
	    </div>

		<h4 class='m-xs colorazul'>Situación de Violencia en los "Hijos"</h4>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Tipo de violencia en los Hijos : </strong>{{$tipoviolenciahijotext}}
				</p>  		    	
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Existe Abandono en los hijos :</strong> {{$ficha->cfhabandono}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Reciben Pension los hijos :</strong> {{$ficha->cfhpensionalimenticia}}
				</p>
				<p class="d3 m-xs">
					<strong>Existe denuncia de pension :</strong> {{$ficha->cfhdenunciapension}}
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Existe denuncia de matrato :</strong> {{$ficha->cfhdenunciamaltrato}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>A que institucion acudio :</strong> {{$institucionhijotext}}
				</p>
				<p class="d3 m-xs">

				</p>
	    </div>


		<h4 class='m-xs colorazul'>Situación de Violencia en los "Adultos Mayores"</h4>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Tipo de violencia en los Adultos : </strong>{{$tipoviolenciaabuelotext}}
				</p>  		    	
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Existe Abandono en los Adultos :</strong> {{$ficha->cfamabandono}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Reciben Pension los Adultos :</strong> {{$ficha->cfampensionalimenticia}}
				</p>
				<p class="d3 m-xs">
					<strong>Existe denuncia de pension :</strong> {{$ficha->cfamdenunciapension}}
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Existe denuncia de matrato :</strong> {{$ficha->cfamdenunciamaltrato}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>A que institucion acudio :</strong> {{$institucionabuelotext}}
				</p>
				<p class="d3 m-xs">

				</p>
	    </div>


	    <div class="det2">
				<p class="m-xs">
					<strong>Observacion :</strong> {{$oconvivenciafamiliar}}
				</p>
	    </div>


	</div>
</article>
