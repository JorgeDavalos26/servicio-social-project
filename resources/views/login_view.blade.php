@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/login_view.js'])

@endsection

@section("template")
    <div class="auth-card shadowed-card">
        <form id="form_login">
            <h2>Ingreso al sistema de trámites</h2>
            <hr class="red"><br>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Correo:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="email" placeholder="Correo" class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Contraseña:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="password" placeholder="Contraseña" class="w-100">
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
                    <button type="button" name="login-button" class="btn btn-success pull-right" onclick="login()">Ingresar</button>
                </div>
            </div>
        </form>
    </div>

@endsection