<table id="tifsituacioneconomica" class="table table-striped table-hover table-fw-widget" name='dtinformacionfamiliar' >
	<thead>
		<tr>
			<th> # </th>
			<th>Nombre</th>
			<th>Ocupacion</th>
			<th>Frecuencia_Actividad</th>
			<th>Remuneracion_Mensual</th>
			<th>Actividades_Extras</th>
			<th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($listafamiliares))
			@foreach($listafamiliares as $index => $item)
				<tr>
					<td class='tditem'>{{$index+1}} </td>
					<td class="tdbusqval" data_id="{{ $item->familiar_id}}" >{{$item->nombrefamiliar}} </td>
					<td class="tdifenfermedad">{{$item->frecuenciaactividad}}</td>
					<td class="tdifparentesco"> {{$item->ocupacionprincipal}}</td>
					<td class="tdifenfermedad">{{$item->remuneracionmensual}}</td>
					<td class="tdifenfermedad">{{$item->actividadesextras}}</td>

					<td class="actions">
						<div class="form-inline">
								
							<button type="button" id='btneliminar{{ $item->id }}' name='btneliminar{{ $item->id }}' class="btn btn-space btneliminarotrofamiliar" data_ficha="{{ $item->ficha_id }}"data_opc="{{ $idopcion }}" data_id="{{ $item->id }}">
								<a class="icon">
									<i class="mdi mdi-delete colorrojo"></i>
								</a>
							</button>
						</div>
					</td>
				</tr>                    
			@endforeach
		@endif
	</tbody>
</table> 




@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif