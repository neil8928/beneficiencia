<label class="col-sm-12 control-label labelleft negrita">Familiar:</label>
<div class="col-sm-12 abajocaja combofamiliares">
	   	{!! Form::select( 'familiar', $combofamiliares, array(),
        [
          'class'       => 'form-control control input-xs selectapoyo' ,
          'id'          => 'familiar',
          'required'    => '',
          'data-aw'     => '01'
        ]) !!}

  </div>

@if(isset($ajax))
<script type="text/javascript">
	$(".selectapoyo").select2({
      width: '100%'
    });
</script> 
@endif  