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
                <div class="panel-heading">Lista de Documentos de la Fichas SocioEconomica: #{{ $ficha->codigo }}
                  <div class="tools">
                    @if($swmodificar==1)
                    <a href="{{ url('/agregar-documento-ficha-socioeconomica/'.$idopcion.'/'.Hashids::encode($ficha->id)) }}" data-toggle="tooltip" data-placement="top" title="Agregar Registro">
                      <span class="icon mdi mdi-plus-circle-o"></span>
                    </a>
                    @endif
                    <a href="{{ url('/gestion-ficha-socieconomica/'.$idopcion) }}" data-toggle="tooltip" data-placement="top" title="Atras">
                      <span class="icon mdi mdi-mail-reply"></span>
                    </a>
                  </div>
                </div>
                <div class="panel-body">
                  <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Documento</th>
                        <th>Activo</th>
                        <th>Ver</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($listadatos))
                        @foreach($listadatos as $index => $item)
                          <tr>
                              <td>{{$index +1 }}</td>
                              <td>{{$item->codigo}}</td>
                              <td>{{$item->descripcion}}</td>
                              <td> 
                                @if($item->activo == 1)  
                                  <span class="icon mdi mdi-check"></span> 
                                @else 
                                  <span class="icon mdi mdi-close"></span> 
                                @endif
                              </td>
                              <td>
                                <a target="_blank" href="{{ url('/descargar-documento-ficha/'.Hashids::encode($item->id)) }}" class="tooltipcss opciones">
                                  Ver
                                </a>
                              </td>
                              <td>
                                  @if($swmodificar==1)
                                    <a href="{{ url('/eliminar-documento-ficha-socioeconomica/'.$idopcion.'/'.$idregistro.'/'.Hashids::encode($item->id)) }}" class="tooltipcss opciones eliminardoc" data_detalle_id = "{{$item->id}}">
                                        <span class="icon mdi mdi-delete" style="color: #eb6357;font-size: 1.3em"></span>
                                    </a>
                                  @else
                                    <span class="icon mdi mdi-close"></span> 
                                  @endif
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