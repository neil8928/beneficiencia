  <label class="col-sm-12 control-label labelleft">Institucion</label>
  <div class="col-sm-5 abajocaja">
    {!! Form::select( 'institucion_id', $comboinstitucion, array(),
                      [
                        'class'       => 'form-control control input-xs' ,
                        'id'          => 'institucion_id',
                        'required'    => '',
                        'data-aw'     => '12'
                      ]) !!}
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
    });
</script>