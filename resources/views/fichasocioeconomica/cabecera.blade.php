<div class="panel-heading panel-heading-general">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<img class="imagenlogoprincipal" src="{{ asset('public/img/logoprincipal.jpg')}}">
			</div>
			<div class="col-sm-6">
				<div class="fechaprincipal">
					<span>
						@if(isset($registro))
							<b>Codigo:</b> {{ $registro->codigo }}
						@endif
						<b>Fecha:</b> {{ date('d-m-Y') }}
					</span>
				</div>
				<div class="comedor">
					<b>{{ $Comedor }}</b>
					@if(isset($registro))
						<span>
							<b>Encuestador:</b> {{ $registro->encuestador->apellido }} {{ $registro->encuestador->nombre }}
						</span>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<hr class="separadorprincipal">
