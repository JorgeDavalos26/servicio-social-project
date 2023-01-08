@extends("templates.main_gobmx_template")

@section("script")
    
@endsection

@section("template")

    <div class="container pt-5">
        <div class="alert alert-danger">
            <br><br>
            <h2 class="display-3 m-0">{{ __('Error') }} 404<i class="ml-3 bi bi-cone-striped"></i></h2>
            <p class="mt-4">Oops! {{ __('Seems you are in a wrong page') }}.</p>
            <br>
            <div class="d-flex flex-column">
                <div><a type="button" class="btn btn-link" href="inicio">{{ __('Go back to main page') }}</a></div>
                <div><a type="button" class="btn btn-link" href="/">{{ __('Go back to landpage') }}</a></div>
            </div>
            <br>
        </div>
    </div>

@endsection