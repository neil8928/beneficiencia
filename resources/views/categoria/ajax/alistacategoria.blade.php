<br>
<table id="table1" class="table table-striped table-hover table-fw-widget">
  <thead>
    <tr>
      <th>Id</th>
      <th>Concepto</th>
      <th>Nombre</th>
      <th>Activo</th>
      <th>Opción</th>
    </tr>
  </thead>
  <tbody>

    @foreach($listadetalle as $index => $item)
      <tr>
        <td>{{$index+1}}</td>
        <td>{{$item->nombreconcepto}}</td>
        <td>{{$item->nombre}}</td>
        <td> 
          @if($item->activo == 1)  
            <span class="icon mdi mdi-check"></span> 
          @else 
            <span class="icon mdi mdi-close"></span> 
          @endif
        </td>
        <td class="rigth">
          <div class="btn-group btn-hspace">
            <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
            <ul role="menu" class="dropdown-menu pull-right">
              <li>
                <a href="{{ url('/modificar-concepto/'.$idopcion.'/'.Hashids::encode(substr($item->id, -8))) }}">
                  Modificar
                </a>  
              </li>
            </ul>
          </div>
        </td>
      </tr>                    
    @endforeach

  </tbody>
</table>
@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
       App.dataTables();
    });
  </script> 
@endif
