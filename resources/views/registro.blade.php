@extends("templates.gobmx_template")

@section("content")

    <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; 
        width: 65%; border-radius: 10px; padding: 50px 60px; margin-right: auto; margin-left: auto; 
        margin-top: 60px; margin-bottom: 60px">

        <h4>Registro en el sistema de trámites</h4>
        <br><br><br>

        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Nombre de Usuario *:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Nombre de usuario" style="width: 100%">
            </div>

        </div>
        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Correo *:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Correo" style="width: 100%">
            </div>

        </div>
        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Contraseña *:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Contraseña" style="width: 100%">
            </div>

        </div>
        <div class="row">

            <div class="col-4" style="text-align: right;">
                <h6>Confirmar contraseña *:</h6>
            </div>
            <div class="col-8">
                <input type="text" placeholder="Confirmar contraseña" style="width: 100%">
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-4" style="text-align: right">
                <span><small>* Campos obligatorios.</small></span>
            </div>
            <div class="col-8">
                <button type="button" class="btn btn-success pull-right">Registrar</button>
            </div>
        </div>

    </div>

@endsection