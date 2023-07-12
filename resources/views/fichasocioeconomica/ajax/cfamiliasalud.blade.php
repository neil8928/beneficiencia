<label class="control-label labelleft negrita" >Seleccione Familiar</label>
<div class="abajocaja combofamiliares">
	 	{!! Form::select( 'familiar', $combofamiliares, array(),
        [
        	'class'       => 'form-control control input-xs familiarof selectsalud' ,
            'id'          => 'familiar',
            'data-aw'     => '14',
        ]) !!}
</div>

@if(isset($ajax))
<script type="text/javascript">
	$(".selectsalud").select2({
      width: '100%'
    });
</script> 
@endif