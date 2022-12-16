@extends("templates.main_gobmx_template")


@section("template")
    @php
        $options = [\App\Helpers\Base_Enums\ScholarLevel::ENGINEERING, App\Helpers\Base_Enums\ScholarLevel::TECNOLOGO];
    @endphp
    <div class="container block">
	<div class="nav nav-tabs" id="nav-tab" role="tablist"> <a class="nav-link active" id="nav-tab-01" data-toggle="tab" href="#nav-01" role="tab" aria-controls="nav-01" aria-selected="true">Registro</a> <a class="nav-link" id="nav-tab-02" data-toggle="tab" href="#nav-02" role="tab" aria-controls="nav-02" aria-selected="false">Configuraciones</a> <a class="nav-link" id="nav-tab-03" data-toggle="tab" href="#nav-03" role="tab" aria-controls="nav-03" aria-selected="false">Estadísticas</a> </div>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-01" role="tabpanel" aria-labelledby="nav-tab-01">
			<div class="row">
				<div class="col">
					<button class="btn btn-primary " data-toggle="collapse" href="#filters" role="button" aria-expanded="false" aria-controls="filters">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
							<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z" /> </svg>
					</button>
				</div>
				<div class="col">
					<div class="btn-group-vertical pull-right" role="group" aria-label="Vertical button group">
						<div class="btn-group " role="group">
							<button id="actions" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> ! </button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="actions">
								<li>
									<button type="button" class="btn">Generar grupo</button>
								</li>
								<li>
									<label class="btn" for="lista-aceptados">Cargar excel de aceptados:</label>
									<input id="lista-aceptados" style="visibility:hidden;display:none;" type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" /> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="collapse multi-collapse w-100" id="filters">
					<!--FILTERS -->
					<div class="card-body ">
						<form role="form">
							<div class="form-group row">
								<label class="col-3 col-form-label" for="name">Nombre:</label>
								<div class="col-9">
									<input class="form-control" id="name" placeholder="Nombre" type="text"> </div>
							</div>
							<div class="form-group row">
								<label class="col-3 col-form-label" for="type-03">Tipo:</label>
								<div class="col-9">
									<select class="form-control"> @foreach($options as $option)
										<option value="{{ \App\Helpers\Base_Enums\ScholarLevel::getText($option) }}">{{ \App\Helpers\Base_Enums\ScholarLevel::getText($option) }}</option> @endforeach </select>
								</div>
							</div>
							<div class="form-group datepicker-group">
								<label class="control-label" for="calendar">Calendario:</label>
								<input class="form-control" id="calendar" type="text"> <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span> </div>
							<div class="form-group row">
								<div class="col">
									<button class="btn btn-primary pull-left" type="submit">Filtrar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td>Mark</td>
						<td>Otto</td>
						<td>@mdo</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>Jacob</td>
						<td>Thornton</td>
						<td>@fat</td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td>Larry</td>
						<td>the Bird</td>
						<td>@twitter</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="nav-02" role="tabpanel" aria-labelledby="nav-tab-02">
			<p> Configuraciones </p>
		</div>
		<div class="tab-pane fade" id="nav-03" role="tabpanel" aria-labelledby="nav-tab-03">
			<p> Estadísticas </p>
		</div>
	</div>
</div>
@endsection

@section("script")
@vite(['resources/js/login_view.js'])
  <script type="text/javascript">
    $(document).ready(function () {
      console.log("$(document).ready has been called!");
      $gmx(document).ready(function() {
  $('#calendar').datepicker();
});
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
@endsection
