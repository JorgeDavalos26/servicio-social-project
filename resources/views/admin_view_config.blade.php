@section("script")

<script>
      $gmx(document).ready(function() {
          console.log("CDN's DOM completed")
      });
  </script> 

  <script type="text/javascript">
    $(document).ready(function () {
      console.log("$(document).ready has been called!");
      $.datepicker.regional.es = {
          closeText: 'Cerrar',
          prevText: 'Ant',
          nextText: 'Sig',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'S&aacute;b'],
          weekHeader: 'Sm',
          dateFormat: 'dd/mm/yy',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''
      };

      $.datepicker.setDefaults($.datepicker.regional.es);
      $("#calendar").datepicker();
      $("#calendarYear").datepicker({changeYear: true});
      $("#datepicker").datepicker();

    });
  </script>
	@vite(['resources/js/admin_view_config.js'])
	@vite(['resources/js/paginate.js'])
	@vite(['resources/js/admin_view_solicitudes.js'])


  


@endsection
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
