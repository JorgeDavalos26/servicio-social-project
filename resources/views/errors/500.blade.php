@extends("templates.main_gobmx_template")

@section("script")
    
@endsection

@section("template")

    <div class="container pt-5">
        <div class="alert alert-danger">
            <br><br>
            <h2 class="display-3 m-0">{{ __('Error') }} 500 
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="ml-3 bi bi-fire" viewBox="0 0 16 16">
                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z"/>
                </svg>
            </h2>
            <p class="mt-4">Oops! {{ __('Seems the server is not in good conditions') }}.</p>
            <p class="mt-2">{{ __('Please, reach out to technical services or try later') }}.</p>
            <br>
            <div class="d-flex flex-column">
                <div><a type="button" class="btn btn-link" href="inicio">{{ __('Go back to main page') }}</a></div>
                <div><a type="button" class="btn btn-link" href="/">{{ __('Go back to landpage') }}</a></div>
            </div>
            <br>
        </div>
    </div>

@endsection