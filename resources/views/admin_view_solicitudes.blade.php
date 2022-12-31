<div class="tab-pane fade show active" id="nav-solicitudes" role="tabpanel" aria-labelledby="nav-tab-01">
	<h2>Solicitudes</h2>
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
						<label class="col-3 col-form-label" for="type-03">Nivel:</label>
						<div class="col-9">
							<select class="form-control" id="select-scholar-level"> @foreach(App\Enums\ScholarLevel::cases() as $key=>$value)
								<option value="{{ $value }}">{{ $value }}</option> @endforeach 
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-3 col-form-label" for="type-03">Curso:</label>
						<div class="col-9">
							<select class="form-control" id="select-course-level"> @foreach(App\Enums\ScholarCourse::cases() as $key=>$value)
								<option value="{{ $value }}">{{ $value }}</option> @endforeach </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-3 col-form-label" for="type-03">Estatus:</label>
						<div class="col-9">
							<select class="form-control" id="select-solicitude-status"> @foreach(App\Enums\SolicitudeStatus::cases() as $key=>$value)
								<option value="{{ $value }}">{{ $value }}</option> @endforeach 
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col">
							<button class="btn btn-primary pull-left" id="btn-filter">Filtrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<table class="table" id="table_admin">
		<thead>
			<tr>
				<th>Número de solicitud</th>
				<th>Período</th>
				<th>Curso</th>
				<th>Nivel</th>
				<th>Usuario</th>
			</tr>
		</thead>
		<tbody id="table_admin_body"> </tbody>
	</table>
	<ul class="pagination" id="pagination"> </ul>
</div>

@section("script")
	@vite(['resources/js/paginate.js'])
	@vite(['resources/js/admin_view_solicitudes.js'])
@endsection
