<label class="col-sm-12 control-label labelleft negrita">Provincia<span class="required">**</span></label>
<div class="col-sm-12 abajocaja">
  {!! Form::select( 'provincia_id', $comboprovincia, array(),
                    [
                      'class'       => 'form-control control input-xs select2' ,
                      'id'          => 'provincia_id',
                      'required'    => '',
                      'data-aw'     => '02'
                    ]) !!}
</div>
<script type="text/javascript">
  $(document).ready(function(){
      //initialize the javascript
      App.init();
      App.formElements();
    });
</script>