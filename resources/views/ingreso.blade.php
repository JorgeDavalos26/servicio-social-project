@extends("templates.gobmx_template")

@section("content")

    <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; 
        width: 60%; border-radius: 10px; padding: 50px 60px; margin-right: auto; margin-left: auto; 
            margin-top: 60px; margin-bottom: 60px;">

        <h4>Ingreso al sistema de trámites</h4>
        <br><br><br>

        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Correo:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Correo" style="width: 100%">
            </div>

        </div>
        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Contraseña:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Contraseña" style="width: 100%">
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-link pull-right">¿Olvido su contraseña?</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-success pull-right">Ingresar</button>
            </div>
        </div>

    </div>

@endsection