<label class="col-sm-12 control-label labelleft">Tipo Institucion</label>
<div class="col-sm-5 abajocaja">
  {!! Form::select( 'tipoinstitucion_id', $combotipoinstitucion, array(),
                    [
                      'class'       => 'form-control control input-xs' ,
                      'id'          => 'tipoinstitucion_id',
                      'required'    => '',
                      'data-aw'     => '11'
                    ]) !!}
</div>
<script type="text/javascript">
  $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
    });
</script>