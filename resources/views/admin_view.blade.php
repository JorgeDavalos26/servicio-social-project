@extends("templates.main_gobmx_template")
@section("template")
@vite(['resources/css/admin_home_view.css'])
<div class="container block">
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-tab-solicitudes" data-toggle="tab" href="#nav-solicitudes" role="tab" aria-controls="nav-solicitudes" aria-selected="true">Solicitudes</a>
    <a class="nav-link" id="nav-tab-config" data-toggle="tab" href="#nav-config" role="tab" aria-controls="nav-config" aria-selected="false">Configuraciones</a>
    <a class="nav-link" id="nav-tab-stats" data-toggle="tab" href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="false">Estadísticas</a>
  </div>
	<div class="tab-content" id="nav-tabContent">
    @include('admin_view_solicitudes')
    @include('admin_view_config')
    @include('admin_view_stats')
	</div>
</div>
@endsection

