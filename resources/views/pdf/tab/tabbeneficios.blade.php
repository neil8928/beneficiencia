<article>
	<div class='titulotab'><b>Beneficios :</b></div>
	<div class="top p-lrxs">

		<h4 class='m-xs colorazul'>Beneficios de los familiares</h4>
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
