@extends("templates.main_gobmx_template")

@section("script")

@endsection

@section("template")

    <div>
        <h2>Perfil</h2>
        <br>
        <p><strong>{{ __('Mail') }}:</strong> {{ auth()->user()->email }}</p>
        <p><strong>{{ __('User') }}:</strong> {{ auth()->user()->username }}</p>
        <br>
    </div>

@endsection