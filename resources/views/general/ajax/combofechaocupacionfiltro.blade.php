<label class="col-sm-12 control-label labelleft" >Ocupacion*** :</label>
<div class="col-sm-12 abajocaja" >
  {!! Form::select( 'ocupacion_id', $comboocupacion, array(),
    [
      'class'       => 'select2 form-control input-xs' ,
      'id'          => 'ocupacion_id',
      'required'    => '',
      'data-aw'     => '1',
    ]) !!}
</div>


<script type="text/javascript">
  $(document).ready(function(){    
    App.formElements();
  });
</script>