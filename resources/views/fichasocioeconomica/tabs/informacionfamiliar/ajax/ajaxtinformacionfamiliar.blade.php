{{-- <table id="tinformacionfamiliar" class="table table-striped table-hover table-fw-widget tinformacionfamiliar" name='dtinformacionfamiliar' > --}}
<table id="tinformacionfamiliar" class="table table-striped table-hover table-fw-widget tinformacionfamiliar" name='dtinformacionfamiliar' >
	<thead>
		<tr>
			<th> # </th>
			<th>Entrevistado</th>
			<th>Nombre</th>
			<th>Edad</th>
			<th>DNI</th>
			<th>Telf.</th>
			<th>Sexo</th>
			<th>Parentesco</th>
			<th>Estado_Civil</th>
			<th>Nivel_Educativo</th>
			<th>Carga_Familiar</th>
			<th>Seguro</th>
			<th>Opcion</th>
		</tr>
	</thead>
	<tbody>
		@if(isset($listafamiliares))
			@foreach($listafamiliares as $index => $item)
				<tr>
					<td class='tditem'>{{$index+1}} </td>
					<td class='tditem'>
							@if($item->swentrevistado == 0)
								NO
							@else
								SI
							@endif
					</td>
					
					<td class="tdifnombre">{{$item->apellidopaterno}} {{$item->apellidomaterno}} {{$item->nombres}} </td>
					<td class="tdifedad">{{$item->edad}}</td>
					<td class="tdifdni">{{$item->dni}}</td>
					<td class="tdiftelefono">{{$item->telefono}}</td>
					<td class="tdifedad">@if($item->sexo==0) H @else M @endif</td>
					<td class="tdifparentesco"> {{$item->parentesco}}</td>
					<td class="tdifestadocivil">{{$item->estadocivil}}</td>
					<td class="tdifniveleducativo">{{$item->niveleducativo}}</td>
					<td class="tdifniveleducativo">{{$item->cargafamiliar}}</td>
					<td class="tdifseguro">{{$item->tiposeguro}}</td>
                                                            
					<td class="actions">
						<div class="form-inline">
							@if(isset($swelim))
								<button type="button" id='btneliminar{{ $item->id }}' name='btneliminar{{ $item->id }}' class="btn btn-space btneliminarotrofamiliar" data_ficha="{{ $item->ficha_id }}"data_opc="{{ $idopcion }}" data_id="{{ $item->id }}">
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
<div class="row">
   	<button type="button" id='btnocultartif' name='btnocultartif' class="btn btn-space btn-general btnguardarprincipal"> Ocultar Tabla </button>
</div>
</div>


@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif