@extends("templates.gobmx_template")

@push("styles")

<style>
  .block
  {
    border: 2px solid #10312B;
    border-radius: 10px;
    margin-top: 20px;
  }

  .col-1, .col-4, .col-6, .col-8
  {
    border: 1px solid black;
  }
</style>

@endpush

@section('content')

    @include("gobmx_elements.flexbox")
    @include('gobmx_elements.colors')
    @include('gobmx_elements.navbar')
    @include("gobmx_elements.forms")
    @include("gobmx_elements.form-elements")
    @include("gobmx_elements.headers_text_and_separator")
    @include("gobmx_elements.lists")
    @include("gobmx_elements.breadcrumbs_and_pagination")
    @include("gobmx_elements.tooltips_and_alerts")
    @include("gobmx_elements.accordions")
    @include('gobmx_elements.tabs')
    @include('gobmx_elements.modals')
    @include("gobmx_elements.datepicker")
    @include("gobmx_elements.icons")
    @include("gobmx_elements.iframes")

@endsection

@section("scripts")

  {{-- <script>
      $gmx(document).ready(function() {
          console.log("CDN's DOM completed")
      });
  </script> --}}

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

@endsection
