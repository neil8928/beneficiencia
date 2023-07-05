  <label class="col-sm-12 control-label labelleft negrita">Distrito<span class="required">**</span></label>
  <div class="col-sm-12 abajocaja">
    {!! Form::select( 'distrito_id', $combodistrito, array(),
                      [
                        'class'       => 'form-control control input-xs select2' ,
                        'id'          => 'distrito_id',
                        'required'    => '',
                        'data-aw'     => '03'
                      ]) !!}
  </div>

<script type="text/javascript">
  $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
    });
</script>