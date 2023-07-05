<div class="col-sm-14">
    {!! Form::select( 'local_id', $combolocal, array(),
                      [
                        'class'       => 'form-control control input-xs' ,
                        'id'          => 'local_id',
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