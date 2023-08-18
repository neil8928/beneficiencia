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
                <div class="panel-heading">Tiempo Restante de Caducidad de Ayuda al Beneficiario
                  <div class="tools">
                    
                  </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Ficha</th>
                        <th>Usuario</th>
                        <th>Localidad</th>
                        <th>Tiempo</th>

                        <th>Estado</th>
                        <th>Opción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($listadatos))
                        @foreach($listadatos as$index => $item)

                          @php 
                            $datetime1 = date_create($item->fechainicio);
                            $datetime2 = date_create(date('Y-m-d'));
                            $contador = date_diff($datetime1, $datetime2);
                            $differenceFormat = '%a';
                            $dias     = $contador->format($differenceFormat);
                          @endphp

                          <tr class="{{ $item->classcolorfila }}">
                              <td>{{$index+1}}</td>
                              <td>{{$item->codigo}}</td>

                              <td class="cell-detail" >
                                <span><b>Fecha Registro : </b> {{$item->fecha}}</span>
                                <span><b>Fecha Pre Aprobacion: </b> {{$item->fechapreaprobacion}}</span>
                                <span><b>Fecha Aprobacion: </b> {{$item->fechaaprobacion}}</span>
                                <span><b>Fecha Fin: </b> {{$item->fechafin}}</span>
                                <span><b>Encuestador : </b> {{$item->encuestador->apellido}} {{$item->encuestador->nombre}}</span>
                              </td>

                              <td class="cell-detail" >
                                <span><b>Nombre : </b> {{$item->apellidopaterno}} {{$item->apellidomaterno}} {{$item->nombres}}</span>
                                <span><b>DNI : </b> {{$item->dni}}</span>
                                <span><b>Telefono : </b> {{$item->telefono}}</span>
                              </td>

                              <td class="cell-detail" >
                                <span><b>Departamento : </b> {{$item->departamento}}</span>
                                <span><b>Provincia : </b> {{$item->provincia}}</span>
                                <span><b>Distrito : </b> {{$item->distrito}}</span>
                              </td>

                              <td class="cell-detail">
                                <span><b>Permanencia : </b> {{($item->anios*365) + ($item->meses*30) + $item->dias}} dias</span>
                                <span><b>Tiempo utilizado : </b> {{$dias}} dias</span>
                                @if($item->indsinlimite==1)
                                  <span><b>Restante : </b> SIN LIMITE</span>
                                @else
                                  <span><b>Restante : </b> {{ $item->tiemporestante }}</span>
                                @endif

                              </td>

                              <td>{{$item->estado->descripcion}}</td>
                              <td class="rigth">
                                <div class="btn-group btn-hspace">
                                  <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Acción <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                  <ul role="menu" class="dropdown-menu pull-right">
                                    @php($opciones = $item->getopciones())
                                    {{-- <li><a href="{{ url('/reevaluar-ficha-socieconomica/'.$idopcion.'/'.Hashids::encode($item->id)) }}" >REEVALUAR</a></li> --}}
                                    <li><a href="{{ url('/pdf-ficha-socieconomica/'.$idopcion.'/'.Hashids::encode($item->id)) }}" target="_blank">PDF</a></li>
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