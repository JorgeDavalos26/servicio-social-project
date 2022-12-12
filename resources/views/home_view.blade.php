@extends("templates.main_gobmx_template")

@section("script")

@endsection

@section("template")

    @php
        $applications = [
            [
                "id" => 1,
                "level" => \App\Helpers\Base_Enums\ScholarLevel::ENGINEERING,
                "course" => \App\Helpers\Base_Enums\ScholarCourse::PROPEDEUTICO,
                "createdAt" => \Carbon\Carbon::now(),
                "state" => \App\Helpers\Base_Enums\ApplicationState::COMPLETED
            ],
            [
                "id" => 2,
                "level" => \App\Helpers\Base_Enums\ScholarLevel::ENGINEERING,
                "course" => \App\Helpers\Base_Enums\ScholarCourse::NIVELATION,
                "createdAt" => \Carbon\Carbon::now(),
                "state" => \App\Helpers\Base_Enums\ApplicationState::COMPLETED
            ],
        ];
    @endphp

    @vite(['resources/css/student-home-view.css'])

    <div class="d-flex justify-content-between align-items-center">
        <h2>Mis registros</h2>
        <div>
            <a class="btn btn-secondary btn-sm" href="/nuevo_registro">
                + Registro
            </a>
            <a class="ml-2" id="go-to-profile-link" href="/perfil" >
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="mb-5">
            @foreach($applications as $application)
                @include('simple-components.application-section')
            @endforeach
        </div>
        <div class="my-4">
            <button type="button" class="btn btn-secondary" onclick="addAlert('warning', 'a warning alert', 10)">Alert
            </button>
            <button type="button" class="btn btn-secondary" onclick="addToast('danger', 'a danger toast', 10)">Toast
            </button>
        </div>
    </div>

@endsection
