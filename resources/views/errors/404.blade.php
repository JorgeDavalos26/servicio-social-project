@extends("templates.main_gobmx_template")

@section("script")
    
@endsection

@section("template")

    <div class="container pt-5">
        <div class="alert alert-danger">
            <br><br>
            <h2 class="display-3 m-0">Error 404<i class="ml-3 bi bi-cone-striped"></i></h2>
            <p class="mt-4">Oops! Parece que te equivocaste de página.</p>
            <br>
            <div class="d-flex flex-column">
                <div><a type="button" class="btn btn-link" href="inicio">Volver a la página principal</a></div>
                <div><a type="button" class="btn btn-link" href="/">Volver al portal</a></div>
            </div>
            <br>
        </div>
    </div>

@endsection