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
          <div class="panel-heading panel-heading-divider">DETALLE PERMANENCIA<span class="panel-subtitle">Modificar Permanencia: {{$registro->nombre}}</span></div>
          <div class="panel-body">


            <form method="POST" action="{{ url('/modificar-concepto/'.$idopcion.'/'.Hashids::encode(substr($registro->id, -8))) }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {{ csrf_field() }}


              <div class="form-group">
                <label class="col-sm-3 control-label negrita">Descripcion</label>
                <div class="col-sm-6">
                  <textarea rows="4"   readonly = 'readonly' disabled class="form-control" data-aw="1">{{ old( 'descripcion', $registro->descripcion) }}                  </textarea>
                </div>
              </div>

              <div class="form-group">

                        <label class="col-sm-3 control-label negrita">Evaluar Vulnerabilidad</label>

                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="radio" value='0' @if($registro->indvulnerabilidad==0) checked @endif disabled
                                name="indvulnerabilidad" class="indvulnerabilidad form-control input-sm" id="rad75">
                                <label for="rad75">NO</label>
                            </div>
                            <div class="be-radio has-success inline">
                                <input type="radio" value='1'  @if($registro->indvulnerabilidad==1) checked @endif disabled
                                name="indvulnerabilidad" class="indvulnerabilidad form-control input-sm" id="rad76"> 
                                <label for="rad76">SI</label>
                            </div>
                        </div>
              </div>




              <div class="form-group">

                        <label class="col-sm-3 control-label negrita">Evaluar Riesgo Social</label>

                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="radio" value='0' @if($registro->indriesgosocial==0) checked @endif disabled 
                                name="indriesgosocial" class="indriesgosocial form-control input-sm" id="rad77">
                                <label for="rad77">NO</label>
                            </div>
                            <div class="be-radio has-success inline"> 
                                <input type="radio" value='1'  @if($registro->indriesgosocial==1) checked @endif disabled 
                                name="indriesgosocial" class="indriesgosocial form-control input-sm" id="rad78">
                                <label for="rad78">SI</label>
                            </div>
                        </div>
              </div>



              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Evaluar Sueldo</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="radio" value='0' @if($registro->indsueldo==0) checked @endif disabled 
                                name="indsueldo" class="indsueldo form-control input-sm" id="rad79">
                                <label for="rad79">NO</label>
                            </div>
                            <div class="be-radio has-success inline"> 
                                <input type="radio" value='1'  @if($registro->indsueldo==1) checked @endif disabled 
                                name="indsueldo" class="indsueldo form-control input-sm" id="rad80">
                                <label for="rad80">SI</label>
                            </div>
                        </div>
              </div>
              
              
              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Sueldo Maximo</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="number" value='{{ $registro->sueldomaximo }}'disabled 
                                name="sueldomaximo" class="sueldomaximo form-control input-sm" id="sueldomaximo">
                            </div>

                        </div>
              </div>


              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Evaluar Cantidad Personas</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="radio" value='0' @if($registro->indcantpersonas==0) checked @endif disabled 
                                name="indcantpersonas" class="indcantpersonas form-control input-sm" id="rad79">
                                <label for="rad79">NO</label>
                            </div>
                            <div class="be-radio has-success inline"> 
                                <input type="radio" value='1'  @if($registro->indcantpersonas==1) checked @endif disabled 
                                name="indcantpersonas" class="indcantpersonas form-control input-sm" id="rad80">
                                <label for="rad80">SI</label>
                            </div>
                        </div>
              </div>
              
              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Cantidad Personas</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="number" value='{{ $registro->cantpersonas }}'disabled 
                                name="cantpersonas" class="cantpersonas form-control input-sm" id="cantpersonas">
                            </div>

                        </div>
              </div>


              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Duracion Años</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="number" value='{{ $registro->anios }}'disabled 
                                name="anios" class="anios form-control input-sm" id="anios">
                            </div>

                        </div>
              </div>

 
              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Duracion Meses</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="number" value='{{ $registro->meses }}'disabled 
                                name="meses" class="meses form-control input-sm" id="meses">
                            </div>

                        </div>
              </div>

 
              <div class="form-group">
                        <label class="col-sm-3 control-label negrita">Duracion Dias</label>
                        <div class="col-sm-6">
                            <div class="be-radio has-danger inline">
                                <input type="number" value='{{ $registro->dias }}'disabled 
                                name="dias" class="dias form-control input-sm" id="dias">
                            </div>

                        </div>
              </div>

            

              <div class="row xs-pt-15">
                <div class="col-xs-6">
                    <div class="be-checkbox"></div>
                </div>
                <div class="col-xs-6">
                  <p class="text-right">
                    <a href="{{ url('/gestion-variables-permanencia/'.$idopcion) }}" >
                      <button type="button" class="btn btn-space btn-danger btn-xl"> Atras </button>
                    </a>
                    {{-- <button type="submit" class="btn btn-space btn-primary">Guardar</button> --}}
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


    <script src="{{ asset('public/lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/dataTables.buttons.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.html5.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.flash.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.print.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.colVis.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/lib/datatables/plugins/buttons/js/buttons.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/app-tables-datatables.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
        App.formElements();
        $('form').parsley();
      });
    </script>
    <script src="{{ asset('public/js/concepto/concepto.js?v='.$version) }}" type="text/javascript"></script>

@stop