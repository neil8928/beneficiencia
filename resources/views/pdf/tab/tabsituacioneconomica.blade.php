<article>
	<div class='titulotab'><b>Situación Económica :</b></div>
	<div class="top p-lrxs">
		<h4 class='m-xs colorazul'>Situacion Economica del hogar</h4>
	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Activos del hogar : </strong>{{$actividadeconomicahogar}}@if($ficha->otrosbienes != '')<small>; (Otros : {{$ficha->otrosbienes}})</small>@endif
				</p>  		    	
	    </div>

	    <h4 class='m-xs colorazul' style="padding-top: 8px;">Actividades Economicas de los familiares</h4>
		  <table>
		    <tr>
		      <th>Nombre del Familiar</th>
		      <th>Parentesco</th>
		      <th>Ocupación</th>
		      <th>Frecuencia de Actividad</th>
		      <th>Remuneracion Mensual</th>
		      <th>Actividades Extras</th>
		    </tr>
		    @foreach($listaactividadeseconomicas as $item)
			    <tr>
			      <td>{{$item->nombrefamiliar}}</td>
			      <td>{{$item->parentesco}}</td>
			      <td>{{$item->ocupacionprincipal}}</td>
			      <td>{{$item->frecuenciaactividad}}</td>
			      <td>{{$item->remuneracionmensual}}</td>
			      <td>{{$item->actividadesextras}}</td>     
			    </tr>
		    @endforeach
		  </table>

	    <div class="det2">
				<p class="m-xs">
					<strong>Observacion :</strong> {{$osituacioneconomica}}
				</p>
	    </div>

	</div>
</article>
