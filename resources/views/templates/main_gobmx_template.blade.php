<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trámites CETI</title>

        <!-- gobmx css -->
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/image/favicon.ico" rel="shortcut icon">
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/css/main.css" rel="stylesheet">

        <!-- add global constant js variables -->
        <?php echo "<script>const app_url = '". url('/') ."';</script>"; ?>

        <!-- js and css scripts from resources folder -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- styles of current page -->
        @yield("styles")
    </head>
    <body>
        <main class="page">
            <div class="page-content">
                <!-- global top navbar -->
                @include('core-components.navbar-component')

                <!-- top navbar as per environment -->
                @include('core-components.topbar-environment')

                <!-- section for alerts -->
                @include('core-components.alert-section')

                <!-- section for alerts -->
                @include('core-components.toast-section')

                <!-- content -->
                <div id="main-content" class="container">
                    <!-- template/html of current page -->
                    @yield("template")
                </div>
            </div>
        </main>
    </body>
    <!-- gobmx js -->
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery.min.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/gobmx.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery-ui-datepicker.js"></script>

    <!-- js of current page -->
    @yield("script")
</html>
