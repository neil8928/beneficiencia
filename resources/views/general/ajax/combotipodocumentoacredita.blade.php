<label class="col-sm-12 control-label labelleft">Tipo Doc Acredita</label>
<div class="col-sm-8 abajocaja">
  {!! Form::select( 'tipodocumentoacredita_id', $combotipodocumentoacredita, array(),
                    [
                      'class'       => 'form-control control input-xs' ,
                      'id'          => 'tipodocumentoacredita_id',                      
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