
<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title">
		 Observacion <span>({{$data_descripcion}})</span>
	</h3>
	<input type="hidden" name="ficha_id" id="ficha_id" value='{{$ficha_id}}'>
	<input type="hidden" name="tab" id="tab" value='{{$tab}}'>
	<input type="hidden" name="idopcion" id="idopcion" value='{{$idopcion}}'>
</div>
<div class="modal-body">
	<div  class="row regla-modal">
	    <div class="col-md-12">
              <div class="panel panel-default">
								<div class="form-group">
								  <label class="col-sm-12 control-label">Observacion</label>
								  <div class="col-sm-12">
                      <textarea 
                      	name="observacion" 
                      	id='observacion' 
                      	class="form-control input-xs"
				        				rows="3" 
				        				cols="50" 
                      	placeholder="Ingrese Observacion">{{$observacion}}</textarea>
								  </div>
								</div>
              </div>

	    </div>
	    <div class="col-md-6">

	    </div>

	</div>
</div>

<div class="modal-footer">
  <button type="submit" data-dismiss="modal" class="btn btn-success btn-guardar-observacion">Guardar</button>
</div>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
      App.formElements();
    });
  </script>
@endif




