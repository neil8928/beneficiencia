@extends('template')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/select2/css/select2.min.css') }} "/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/lib/bootstrap-slider/css/bootstrap-slider.css') }} "/>

@stop
@section('section')

<div class="be-content">
  <div class="main-content container-fluid">

    <!--Basic forms-->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
          <div class="panel-heading panel-heading-divider">GRUPO OPCION<span class="panel-subtitle">Crear un nuevo Grupo Opcion</span></div>
          <div class="panel-body">
            <form method="POST" action="{{ url('/agregar-grupoopcion/'.$idopcion) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {{ csrf_field() }}

              <div class="form-group">
                <label class="col-sm-3 control-label">Nombres</label>
                <div class="col-sm-6">

                    <input  type="text"
                            id="nombre" name='nombre' value="{{ old('nombre') }}" placeholder="Nombres"
                            required = ""
                            autocomplete="off" class="form-control input-sm" data-aw="1"/>

                    @include('error.erroresvalidate', [ 'id' => $errors->has('nombre')  , 
                                                        'error' => $errors->first('nombre', ':message') , 
                                                        'data' => '1'])

                </div>
              </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Icono</label>
                <div class="col-sm-6">

                    <input  type="text"
                            id="icono" name='icono' value="{{ old('icono') }}" placeholder="iconos"
                            required = ""
                            autocomplete="off" class="form-control input-sm" data-aw="1"/>

                    @include('error.erroresvalidate', [ 'id' => $errors->has('icono')  , 
                                                        'error' => $errors->first('icono', ':message') , 
                                                        'data' => '1'])

                </div>
              </div>
              @include('usuario.iconos')
              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox">

                    </div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <button type="submit" class="btn btn-space btn-primary">Guardar</button>
                    <a href="{{ url('/gestion-de-grupoopciones/'.$idopcion) }}"><button type="button" class="btn btn-space btn-danger">Cancelar</button></a>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  



@stop

@section('script')



	  <script src="{{ asset('public/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>        
    <script src="{{ asset('public/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/parsley/parsley.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/js/app-icons.js?v='.$version) }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app/usuarios.js?v='.$version) }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
        $('form').parsley();
      });
    </script> 
@stop