<table id="tbeneficios" class="table table-striped table-hover table-fw-widget tbeneficios" name='dttbeneficios' style="width:100%">
	<thead>
		<tr>
			<th> # </th>
			<th>Familiar</th>
			<th>Beneficiario</th>
			<th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($listabeneficios))
			@foreach($listabeneficios as $index => $item)
				<tr class="select"
						data_familiar_id = '{{$item->familiar_id}}'
						data_programabeneficiario_id = '{{$item->programabeneficiario_id}}'

						>
					<td >{{$index+1}} </td>
					<td >{{$item->nombrefamiliar}}</td>
					<td >{{$item->nombreprogramabeneficiario}}</td> 

					<td class="actions">
						<div class="form-inline">
							@if(isset($swelim))
							<button type="button" id='btneliminar{{ $item->id }}' name='btneliminar{{ $item->id }}' class="btn btn-space btneliminarbeneficio" data_ficha="{{ $item->ficha_id }}"data_opc="{{ $idopcion }}" data_id="{{ $item->id }}">
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


@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif