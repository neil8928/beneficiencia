@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/dataTables.bootstrap.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datatables/css/buttons.dataTables.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/general.css?v='.$version) }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css?v='.$version) }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

@stop
@section('section')


  <div class="be-content">
    <div class="main-content container-fluid lconceptos">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-success">
                <div class="panel-heading">Lista de Categorias
                  <div class="tools">

                    <a href="{{ url('/agregar-concepto/'.$idopcion) }}" data-toggle="tooltip" data-placement="top" title="Crear Concepto" style="padding-right: 15px;">
                      <span class="icon mdi mdi-plus-circle-o"></span>
                    </a>

                    <a href="#" data-toggle="tooltip" data-placement="top" title="Buscar Concepto" class="buscarconcepto">
                      <span class="icon mdi mdi-search"></span>
                    </a>


                  </div>


                </div>
                <div class="panel-body">


                <div class='filtrotabla row'>
                  <div class="col-xs-12">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 cajareporte">
                        <div class="form-group">
                          <label class="col-sm-12 control-label labelleft" >Elegir categoría:</label>
                          <div class="col-sm-12 abajocaja" >
                          {!! Form::select( 'concepto_id', $comboconcepto, array(),
                                            [
                                              'class'       => 'form-control control select2' ,
                                              'id'          => 'concepto_id',
                                              'required'    => '',
                                              'data-aw'     => '1'
                                            ]) !!}
                          </div>
                        </div>
                    </div>
                    <input type="hidden" name="idopcion" id='idopcion' value='{{$idopcion}}'>
                  </div>
                </div>


                <div class="listajax">

                  @include('categoria.ajax.alistacategoria')
                 
                </div>




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

  <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/select2/js/select2.min.js?v='.$version) }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/lib/jquery.niftymodals/dist/jquery.niftymodals.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
                App.formElements();
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script> 

  <script src="{{ asset('public/js/concepto/concepto.js?v='.$version) }}" type="text/javascript"></script>



@stop