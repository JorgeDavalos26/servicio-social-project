<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gobmx layout</title>
        <!-- GOBMX CSS -->
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/image/favicon.ico" rel="shortcut icon">
        <link href="https://framework-gb.cdn.gob.mx/gm/v4/css/main.css" rel="stylesheet">
        @stack("styles")
        <!-- CSS from the /public folder -->
        <!-- <link href="{{ asset('app.css') }}" rel="stylesheet"> -->
        <!-- CSS and JS from resources/css | resources/js folders -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head>
    <body>
        <!-- Contenido -->
        <main class="page">
            <div class="page-content">
                @include('components.navbar-component')
                <div class="container my-5">
                    @yield("template")
                </div>
            </div>
        </main>
    </body>
    <!-- GOBMX JS -->
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery.min.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/gobmx.js"></script>
    <script src="https://framework-gb.cdn.gob.mx/gm/v4/js/jquery-ui-datepicker.js"></script>
    @yield("script")
</html>
