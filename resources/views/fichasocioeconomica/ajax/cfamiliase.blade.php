<label class="col-sm-12 control-label labelleft negrita">Actividades economicas del familiar :</label>
<div class="col-sm-12 abajocaja combofamiliares">
	   	{!! Form::select( 'familiar', $combofamiliares, array(),
        [
          'class'       => 'form-control control input-xs selectse' ,
          'id'          => 'familiar',
          'required'    => '',
          'data-aw'     => '01'
        ]) !!}
</div>

@if(isset($ajax))
<script type="text/javascript">
	$(".selectse").select2({
      width: '100%'
    });
</script> 
@endif