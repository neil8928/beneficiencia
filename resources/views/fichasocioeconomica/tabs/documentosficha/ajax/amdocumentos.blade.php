
<div class="modal-header">
	<button type="button" data-dismiss="modal" aria-hidden="true" class="close modal-close"><span class="mdi mdi-close"></span></button>
	<h3 class="modal-title">
		 Agregar Documentos:
	</h3>
	<input type="hidden" name="ficha_id" id="ficha_id" value='{{$ficha_id}}'>

	<input type="hidden" name="idopcion" id="idopcion" value='{{$idopcion}}'>
</div>
<div class="modal-body">
	<div  class="row regla-modal">
	    <div class="col-md-12">
            <div class="panel panel-default">
				<div class="form-group">
					<label class="col-sm-12 control-label labelleft negrita"><h3>Archivo a Subir :</h3></label>
					<div class="col-sm-12 abajocaja">
						<input type="file" name="files[]" id='files' class="form-control control input-sm">
					</div>
				</div>
			</div>
      </div>
  	</div>
	<div class="col-md-6">

	</div>

</div>

<div class="modal-footer">
  <button type="submit" data-dismiss="modal" class="btn btn-success btn-guardar-documentoficha">Guardar</button>
</div>

@if(isset($ajax))
  <script type="text/javascript">
    $(document).ready(function(){
      App.formElements();



    });
  </script>
@endif




