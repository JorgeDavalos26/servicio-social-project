<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gobmx layout</title>

        <!-- CSS -->
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/image/favicon.ico" rel="shortcut icon">
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/css/main.css" rel="stylesheet">

        <style>
            /* .page-content
            {
                min-height: calc(100vh - 433.433px - 60px);
            } */
        </style>

        @stack("styles")
    </head>
    <body>
        <!-- Contenido -->
        <main class="page">
            <div class="page-content">
                <div class="container mb-5 mt-5">
                    @yield("content")
                </div>
            </div>
        </main>
    </body>

    <!-- JS -->
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery.min.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/gobmx.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery-ui-datepicker.js"></script>

    @yield("scripts")
</html>
