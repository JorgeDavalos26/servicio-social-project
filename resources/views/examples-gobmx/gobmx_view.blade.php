@extends("templates.main_gobmx_template")

@section("styles")

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

@endsection

@section('template')

    @include("examples-gobmx.flexbox")
    @include('examples-gobmx.colors')
    @include('examples-gobmx.navbar')
    @include("examples-gobmx.forms")
    @include("examples-gobmx.form-elements")
    @include("examples-gobmx.headers_text_and_separator")
    @include("examples-gobmx.lists")
    @include("examples-gobmx.breadcrumbs_and_pagination")
    @include("examples-gobmx.tooltips_and_alerts")
    @include("examples-gobmx.accordions")
    @include('examples-gobmx.tabs')
    @include('examples-gobmx.modals')
    @include("examples-gobmx.datepicker")
    @include("examples-gobmx.icons")
    @include("examples-gobmx.iframes")

@endsection

@section("script")

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
