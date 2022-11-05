@extends("templates.main_gobmx_template")

@section("script")
    
@endsection

@section("template")

    @php 
        $applications = [
            [
                "level" => "Tecnólogo",
                "courses" => ["Propedéutico", "Nivelación"]
            ],
            [
                "level" => "Ingeniería",
                "courses" => ["Propedéutico", "Nivelación"]
            ],
        ];
    @endphp

    <h2>Panel principal de trámites</h2>
    <div class="container">
        @foreach ($applications as $application)
            @include('simple-components.application-sections')
        @endforeach
        <div class="my-4">
            <button type="button" class="btn btn-secondary" onclick="addAlert('warning', 'a warning alert', 10)">Alert</button>
            <button type="button" class="btn btn-secondary" onclick="addToast('danger', 'a danger toast', 10)">Toast</button>
        </div>
    </div>

@endsection