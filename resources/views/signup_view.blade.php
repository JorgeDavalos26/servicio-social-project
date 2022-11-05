@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/signup_view.js'])
    
@endsection

@section("template")

    <div class="auth-card shadowed-card">
        <form id="form_signup">
            <h2>Registro en el sistema de trámites</h2>
            <hr class="red"><br>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Nombre de Usuario *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="username" placeholder="Nombre de usuario" class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Correo *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="email" placeholder="Correo" class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Contraseña *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="password" placeholder="Contraseña" class="w-100">
                </div>
            </div>
            <div class="row my-3">
                <div class="col-4 text-right">
                    <span><strong>Confirmar contraseña *:</strong></span>
                </div>
                <div class="col-8">
                    <input type="text" name="password2" placeholder="Confirmar contraseña" class="w-100">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-4 text-right">
                    <span><small>* Campos obligatorios.</small></span>
                </div>
                <div class="col-8">
                    <button type="button" class="btn btn-success pull-right" onclick="signup()">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    
@endsection