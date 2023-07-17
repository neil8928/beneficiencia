<table id="tsaluddiscapacidad" class="table table-striped table-hover table-fw-widget" name='dtinformacionfamiliar' >
	<thead>
		<tr>
			<th> # </th>
			<th>Discapacidad</th>
			<th>Nivel</th>
			<th>Espec_Discapacidad</th>
			<th>Seguro</th>
<!-- 			<th>Espec_Seguro</th> -->
			<th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($listadiscapacidad))
			@foreach($listadiscapacidad as $index => $item)
				<tr
						class="select"
						data_discapacidad_id = '{{$item->discapacidad_id}}'
						data_niveldiscapacidad_id = '{{$item->niveldiscapacidad_id}}'
					>
					<td class='tditem'>{{$index+1}} </td>
					<td class="tdbusqval" data_id="{{ $item->discapacidad_id}}" >{{$item->discapacidad}} </td>
					<td class="tdniveldiscapacidad" data_id2="{{ $item->niveldiscapacidad_id}}" >{{$item->niveldiscapacidad}} </td>
					<td class="tdtipodiscapacidad"> {{$item->tipodiscapacidad}}</td>
					<td class="tdtiposeguro">{{$item->tiposeguro}}</td>
<!-- 					<td class="tdcadtiposeguro">{{$item->cadtiposeguro}}</td> -->

					<td class="actions">
						<div class="form-inline">
							@if(isset($swelim))

							<button type="button" id='btneliminar{{ $item->id }}' name='btneliminar{{ $item->id }}' class="btn btn-space btneliminarregistro" data_ficha="{{ $item->ficha_id }}"data_opc="{{ $idopcion }}" data_id="{{ $item->id }}">
								<a class="icon">
									<i class="mdi mdi-delete colorrojo"></i>
								</a>
							</button>
							@else
								<span class="icon mdi mdi-close"></span> 
							@endif
						</div>
					</td>
				</tr>                    
			@endforeach
		@endif
	</tbody>
</table> 


</div>


@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif