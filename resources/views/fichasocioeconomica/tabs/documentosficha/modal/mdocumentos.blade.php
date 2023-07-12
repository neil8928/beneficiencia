<!-- Configuracion-->
<div id="modal-documentos-ficha" class="modal-container colored-header colored-header-primary modal-effect-8">
  <div class="modal-content ">
  <form method="POST" action="{{ url('/agregar-documento-ficha') }}" style="border-radius: 0px;" class="form-horizontal group-border-dashed" enctype="multipart/form-data">
	{{ csrf_field() }}
		<div class='modal-documentos-ficha-container'>

		</div>
	</form>
  </div>
</div>

<div class="modal-overlay"></div>



