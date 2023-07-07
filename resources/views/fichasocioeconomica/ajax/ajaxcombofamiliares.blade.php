{!! Form::select( 'familiar', $combofamiliares, array(),
    [
    	'class'       => 'form-control control input-xs familiarof select2' ,
        'id'          => 'familiar',
        'data-aw'     => '14',
    ]) !!}

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
		App.formElements();
    });
  </script> 
@endif