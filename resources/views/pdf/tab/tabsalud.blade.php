<article>
	<div class='titulotab'><b>Salud :</b></div>
	<div class="top p-lrxs">


		<h4 class='m-xs colorazul'>Enfermedades recientes del usuario</h4>
	  	<table>
		    <tr>
		      <th>Informacion Principal</th>
		      <th>Informacion Enfermedad</th>
		    </tr>

		    @foreach($listadiscapacidadbeneficiario as $item)
			    <tr>
			      <td>
					<b>Nombres : </b>{{$ficha->apellidopaterno}} {{$ficha->apellidomaterno}} {{$ficha->nombres}}<br> 
					<b>Fecha Nacimiento : </b>{{date_format(date_create($ficha->fechanacimiento), 'd/m/Y')}}<br> 
					<b>Edad : </b>{{$ficha->edad}}<br> 
					<b>Sexo : </b>@if ($ficha->sexo == 0) Masculino @else Femenino @endif<br>
					<b>Dni : </b>{{$ficha->dni}}<br>
			      </td>
			      <td>
					<b>Discapacidad : </b>{{$item->discapacidad}}<br> 
					<b>Nivel Discapacidad : </b>{{$item->niveldiscapacidad}}<br> 
					<b>Tipo Discapacidad : </b>{{$item->tipodiscapacidad}}<br> 
					<b>Tipo Seguro : </b>{{$item->tiposeguro}} 
					@if($item->cadtiposeguro != '')<small>({{$item->cadtiposeguro}})</small>@endif			      
				  </td>
						      
			    </tr>
		    @endforeach
	  	</table>


		<h4 class='m-xs colorazul'>Enfermedades recientes de los familiares</h4>
	  	<table>
		    <tr>
		      <th>Nombre del familiar</th>
		      <th>Parentesco</th>
		      <th>Enfermedad</th>
		    </tr>
		    @foreach($listafamiliaressalud as $item)
			    <tr>
			      <td>{{$item->nombrefamiliar}}</td>
			      <td>{{$item->parentesco}}</td>
			      <td>{{$item->enfermedad}}</td>						      
			    </tr>
		    @endforeach
	  	</table>

		<h4 class='m-xs colorazul'>Mortalidad de algun familiar</h4>
	  	<table>
		    <tr>
		      <th>Nombre del familiar</th>
		      <th>Parentesco</th>
		      <th>Enfermedad de deceso</th>
		      <th>Lugar de fallecimiento</th>
		    </tr>
		    @foreach($listafamiliaresmortalidad as $item)
			    <tr>
			      <td>{{$item->nombrefamiliar}}</td>
			      <td>{{$item->parentesco}}</td>
			      <td>{{$item->enfermedad}}</td>
			      <td>{{$item->lugarfallecimiento}} @if($item->cadlugarfallecimiento != '')<small>({{$item->cadlugarfallecimiento}})</small>@endif
			      </td>						      
			    </tr>
		    @endforeach
	  	</table>

	    <div class="det2">
				<p class="m-xs">
					<strong>Observacion :</strong> {{$osalud}}
				</p>
	    </div>

	</div>
</article>
