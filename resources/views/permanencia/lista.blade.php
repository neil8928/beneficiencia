@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/buttons.dataTables.min.css') }} "/>
@stop
@section('section')
  <div class="be-content">
    <div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-danger">
                <div class="panel-heading">Lista de Parametros de Permanencia
                  <div class="tools">
                      <a href="{{ url('/registrar-'.$url.'/'.$idopcion) }}" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
                        <span class="icon mdi mdi-plus-circle-o"></span>
                      </a>
                  </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Descripcion</th>
                        <th>Edad Min</th>
                        <th>Edad Max</th>
                        <th title="Vulnerabilidad">Vulnerabilidad</th>
                        <th title="Riesgo Social">R. Social</th>
                        <th>Ind Sueldo</th>
                        <th>Sueldo Maximo</th>
                        <th>Ind Cant Personas</th>
                        <th>Cant Personas</th>
                        <th>Duracion</th>
                        <th>Activo</th>
                        <th>Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($listadatos))
                        @foreach($listadatos as$index => $item)
                          <tr>
                              <td>{{$index+1}}</td>
                              <td class="cell-detail" >
                                <span><b>{{$item->descripcion}}</b></span>
                              </td>
                              
                              <td> 
                                {{ isset($item->edadmin)?$item->edadmin:'sin limite'  }} 
                              </td> 
                              <td> 
                                {{ isset($item->edadmax)?$item->edadmax:'sin limite' }} 
                              </td>

                              <td> 
                                @if($item->indvulnerabilidad == 1)  
                                  <span class="icon mdi mdi-check"></span> 
                                @else 
                                  <span class="icon mdi mdi-close"></span> 
                                @endif
                              </td>

                              <td> 
                                @if($item->indriesgosocial == 1)  
                                  <span class="icon mdi mdi-check"></span> 
                                @else 
                                  <span class="icon mdi mdi-close"></span> 
                                @endif
                              </td>


                              <td> 
                                @if($item->indsueldo == 1)  
                                  <span class="icon mdi mdi-check"></span> 
                                @else 
                                  <span class="icon mdi mdi-close"></span> 
                                @endif
                              </td>

                              <td> 
                                {{ $item->sueldomaximo  }} 
                              </td>

                              <td> 
                                @if($item->indcantpersonas == 1)  
                                  <span class="icon mdi mdi-check"></span> 
                                @else 
                                  <span class="icon mdi mdi-close"></span> 
                                @endif
                              </td>

                              <td> 
                                {{ $item->cantpersonas  }} 
                              </td>


                              <td class="cell-detail" >
                                @if($item->indsinlimite==1)
                                  <span><b>SIN LIMITE </b></span>
                                @else
                                  <span><b>Años  : </b> {{$item->anios}}</span>
                                  <span><b>Meses : </b> {{$item->meses}}</span>
                                  <span><b>Dias  : </b> {{$item->dias}}</span>
                                @endif
                              </td>

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
                                    <li><a href="{{ url('/detalle-'.$url.'/'.$idopcion.'/'.Hashids::encode($item->id)) }}" >DETALLE</a></li>
                                    <li><a href="{{ url('/eliminar-'.$url.'/'.$idopcion.'/'.Hashids::encode($item->id)) }}" >ELIMINAR</a></li>
                                  </ul>
                                </div>
                              </td>
                          </tr>                    
                        @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>

@stop

@section('script')

  <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/jszipoo.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/pdfmake.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/vfs_fonts.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-tables-datatables.js?v='.$version) }}" type="text/javascript"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.dataTables();
      $('[data-toggle="tooltip"]').tooltip(); 
    });
  </script> 
@stop