@php
	$settingService = settings();
@endphp

<div class="tab-pane fade" id="nav-config" role="tabpanel" aria-labelledby="nav-tab-config">
	<h2> Configuraciones </h2>
	<div id="reception">
		<h4>Recepcion de solicitudes</h4>
		<div class="checkbox" id="receptions">
			@foreach($settingService->getReceiveUpcomingSolicitudes() as $key=>$upcomingSolicitude)
				<label>
					<input type="checkbox"  name={{$upcomingSolicitude->key}}
					{{ $upcomingSolicitude->value == 1 ? "checked" : ""}}>
					{{ $upcomingSolicitude->description }}
					</input>
				</label>
			@endforeach
		</div>
		<button class="btn btn-primary " id="btn-reception">Guardar cambios</button>

	</div>
	<div id="periodos">

	</div>
</div>
