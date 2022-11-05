@extends("templates.main_gobmx_template")

@section("script")

@endsection

@section("template")

    <div>
        <h2>Perfil</h2>
        <br>
        <p><strong>Correo:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Usuario:</strong> {{ auth()->user()->username }}</p>
        <br>
    </div>

@endsection