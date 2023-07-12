<table id="tifsituacioneconomica" class="table table-striped table-hover table-fw-widget" name='dtinformacionfamiliar' >
	<thead>
		<tr>
			<th> # </th>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($listadocumentos))
			@foreach($listadocumentos as $index => $item)
				<tr>
					<td class='tditem'>{{$index+1}} </td>
					<td class="tdbusqval" data_id="{{ $item->codigo}}" >{{$item->codigo}} </td>
					<td class="tddescripcion">{{$item->descripcion}}</td>
					<td class="actions">
						<div class="form-inline">
								
							<button type="button" id='btneliminar{{ $item->id }}' name='btneliminar{{ $item->id }}' class="btn btn-space btneliminarregistro" data_ficha="{{ $item->ficha_id }}"data_opc="{{ $idopcion }}" data_id="{{ $item->id }}">
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