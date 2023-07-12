<article>
	<div class='titulotab'><b>Información Familiar :</b></div>
	<div class="top p-lrxs">
		<h4 class='m-xs colorazul'>Datos del Usuario</h4>
	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Nombres :</strong> {{$ficha->nombres}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Apellido Paterno :</strong> {{$ficha->apellidopaterno}}
				</p>
				<p class="d3 m-xs">
					<strong>Apellido Materno :</strong> {{$ficha->apellidomaterno}}
				</p>

	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Fecha Nacimiento :</strong> {{date_format(date_create($ficha->fechanacimiento), 'd/m/Y')}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Edad :</strong> {{$ficha->edad}} 
				</p>
				<p class="d3 m-xs">
					<strong>Sexo :</strong> @if ($ficha->sexo == 0) Masculino @else Femenino @endif
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>DNI :</strong> {{$ficha->dni}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Telefono :</strong> {{$ficha->telefono}} 
				</p>
				<p class="d3 m-xs">
					<strong>Correo :</strong> {{$ficha->email}}
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Estado Civil :</strong> {{$ficha->estadocivil}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Nivel Educativo :</strong> {{$ficha->niveleducativo}} 
				</p>
				<p class="d3 m-xs">
					<strong>Tipo de Seguro :</strong> {{$ficha->tiposeguro}}
				</p>
	    </div>

	    <div class="det2">
				<p class="d1 m-xs">
					<strong>Carga Familiar :</strong> {{$ficha->cargafamiliar}}
				</p>  		    	
				<p class="d2 m-xs">
					<strong>Entrevistado :</strong> @if ($ficha->swentrevistado == 1) SI @else NO @endif
				</p>
				<p class="d3 m-xs">
					
				</p>
				<p class="m-xs">
					<strong>Observacion :</strong> {{$oinformacionfamiliar}}
				</p>
	    </div>
	    <h4 class='m-xs colorazul' style="padding-top: 8px;">Datos de los Familiares</h4>

		  <table>
		    <tr>
		      <th>Informacion Principal</th>
		      <th>Contactar</th>
		      <th>Informacion Secundaria</th>
		    </tr>

		    @foreach($listafamiliares as $item)
			    <tr>
			      <td>
					<b>Nombres : </b>{{$item->apellidopaterno}} {{$item->apellidomaterno}} {{$item->nombres}}<br> 
					<b>Fecha Nacimiento : </b>{{date_format(date_create($item->fechanacimiento), 'd/m/Y')}}<br> 
					<b>Edad : </b>{{$item->edad}}<br> 
					<b>Sexo : </b>@if ($item->sexo == 0) Masculino @else Femenino @endif<br>
					<b>Dni : </b>{{$item->dni}}<br>
			      </td>
			      <td>
					<b>Telefono : </b>{{$item->telefono}}<br> 
					<b>Correo : </b>{{$item->email}}<br> 
					<b>Parentesco : </b>{{$item->parentesco}}<br> 
					<b>Entrevistado : </b>@if ($item->swentrevistado == 1) SI @else NO @endif
			      </td>
			      <td>
					<b>Estado Civil : </b>{{$item->estadocivil}}<br> 
					<b>Nivel Educativo : </b>{{$item->niveleducativo}}<br> 
					<b>Tipo seguro : </b>{{$item->tiposeguro}}<br> 
					<b>Carga Familiar : </b>{{$item->cargafamiliar}}
			      </td>
  					      
			    </tr>
		    @endforeach



		  </table>


	</div>
</article>
