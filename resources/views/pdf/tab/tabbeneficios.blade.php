<article>
	<div class='titulotab'><b>Beneficios :</b></div>
	<div class="top p-lrxs">


		<h4 class='m-xs colorazul'>Programa beneficiario del Usuario</h4>
	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Programa beneficiario : </strong>{{$programabeneficiariousuariotext}}
				</p>  		    	
	    </div>

		<h4 class='m-xs colorazul'>Programa beneficiario de la Familia</h4>
	  	<table>
		    <tr>
		      <th>Nombre del Familiar</th>
		      <th>Nombre el Programa</th>
		    </tr>
		    @foreach($listabeneficios as $item)
			    <tr>
			      <td>{{$item->nombrefamiliar}}</td>
			      <td>{{$item->nombreprogramabeneficiario}}</td>						      
			    </tr>
		    @endforeach
	  	</table>

	    <div class="det2">
				<p class="m-xs">
					<strong>Observacion :</strong> {{$obeneficios}}
				</p>
	    </div>

	</div>
</article>
