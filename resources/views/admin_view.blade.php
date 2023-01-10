@extends("templates.main_gobmx_template")
@section("script")
    @vite(['resources/js/admin.utils.js'])
    @vite(['resources/js/admin_view_config.js'])
    @vite(['resources/js/paginate.js'])
    @vite(['resources/js/admin_view_solicitudes.js'])
    @vite(['resources/js/admin_view_groups.js'])

    <script type="text/javascript">
		$(document).ready(function () {
			/* 
            creo que no se necesita esto x2
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
			$.datepicker.setDefaults($.datepicker.regional.es); */
			$("#calendar").datepicker();
		});
	</script>

@endsection

@section("template")
    @vite(['resources/css/admin_home_view.css'])

    <div class="container block my-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="nav-tab-solicitudes" data-toggle="tab" href="#nav-solicitudes" role="tab"
               aria-controls="nav-solicitudes" aria-selected="true">{{ __('Solicitudes') }}</a>
            <a class="nav-link" id="nav-tab-config" data-toggle="tab" href="#nav-config" role="tab"
               aria-controls="nav-config" aria-selected="false">{{ __('Settings') }}</a>
            <a class="nav-link" id="nav-tab-stats" data-toggle="tab" href="#nav-stats" role="tab"
               aria-controls="nav-stats" aria-selected="false">{{ __('Statistics') }}</a>
            <a class="nav-link" id="nav-tab-groups" data-toggle="tab" href="#nav-groups" role="tab"
               aria-controls="nav-groups" aria-selected="false">{{ __('Groups') }}</a>
        </div>
        <div class="tab-content" id="nav-tabContent">
            @include('admin_view_solicitudes')
            @include('admin_view_config')
            @include('admin_view_stats')
            @include('admin_view_groups')
        </div>
    </div>
@endsection

