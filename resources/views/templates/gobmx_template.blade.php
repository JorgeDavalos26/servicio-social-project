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

        @stack("styles")
    </head>
    <body>
        <small>~ gobmx template ~</small>

        <!-- Contenido -->
        <main class="page">
            @yield("content")
        </main>
        
        <small>~ gobmx template ~</small>
    </body>

    <!-- JS -->
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery.min.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/gobmx.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery-ui-datepicker.js"></script>

    @yield("scripts")

</html>
