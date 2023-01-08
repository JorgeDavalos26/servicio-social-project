@php
	$settingService = settings();
@endphp

@vite(['resources/css/admin-view.css'])

<div class="tab-pane fade" id="nav-config" role="tabpanel" aria-labelledby="nav-tab-config">
	<h2>{{ __('Settings') }}</h2>
	<div id="reception">
		<h4>Recepcion de solicitudes</h4>
		<div class="nav nav-tabs" id="nav-tab-config-internal" role="tablist">
    </div>
    <div class="tab-content" id="nav-tabContent-config-internal">
    </div>

	<div class="form-group datepicker-group">
		<label class="control-label" for="calendar">Calendario:</label>
		<input class="form-control" id="calendarjojo" type="text">
		<span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span>
    </div>	

	<!-- <div class="checkbox" id="receptions"> @foreach($settingService->getReceiveUpcomingSolicitudes() as $key=>$upcomingSolicitude) @endforeach
		<div class="nav nav-tabs" id="nav-tab" role="tablist"> @foreach($settingService->getReceiveUpcomingSolicitudes() as $key=>$upcomingSolicitude)
				<a class="nav-link " id="nav-tab-{{$upcomingSolicitude->id}}" data-toggle="tab" href="#nav-{{$upcomingSolicitude->id}}" role="tab" aria-controls="nav-{{$upcomingSolicitude->id}}" aria-selected="false"> {{$upcomingSolicitude->id}}</a> @endforeach </div>
		<div class="tab-content" id="nav-tabContent"> @foreach($settingService->getReceiveUpcomingSolicitudes() as $key=>$upcomingSolicitude)
			<div class="tab-pane fade" id="nav-{{$upcomingSolicitude->id}}" role="tabpanel" aria-labelledby="nav-tab-{{$upcomingSolicitude->id}}">
				<div class="row">
					<div class="col-6">
						<div class="row">
							<label> Alumnos por grupo
								<input type="text" name="123"> </label>
						</div>
						<div class="row">
							<label>
								<input type="checkbox" name={{$upcomingSolicitude->key}} {{ $upcomingSolicitude->value == 1 ? "checked" : ""}}> Recibir solicitudes 
							</label>
						</div>
					</div>
					<div class="col-6">
						<button class="btn btn-primary hidden" id="btn-reception">Actualizar cambios</button>
					</div>
				</div>
			</div> @endforeach </div>
	</div>
	<button class="btn btn-primary " id="btn-reception">Guardar cambios</button> -->

	</div>
	<div id="periodos"> </div>
</div>
