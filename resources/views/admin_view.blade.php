@extends("templates.main_gobmx_template")
@section("script")
    @vite(['resources/js/admin_view_config.js'])
    @vite(['resources/js/paginate.js'])
    @vite(['resources/js/admin_view_solicitudes.js'])
    @vite(['resources/js/admin_view_groups.js'])
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

