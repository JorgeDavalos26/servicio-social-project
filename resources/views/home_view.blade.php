@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/home_view.js'])

@endsection

@section("template")

    @vite(['resources/css/student-home-view.css'])

    <div class="modal fade" id="newRegistryModalForm" tabindex="1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="newRegistryModalFormTitle">
                        Nuevo Registro
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="control-label d-flex align-items-center" for="solicitude_type_select">
                            Tipo de formulario
                            <span class="help-icon ml-3" data-toggle="tooltip" data-placement="top"
                                  data-original-title="Ayuda">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-question-circle" viewBox="0 0 16 16">
                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path
                                      d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                                </svg>
                            </span>
                        </label>
                        <select id="solicitude_type_select" name="scholar-course" class="form-control">
                            <option></option>
                            @foreach($forms as $form)
                                <option value="{{$form['id']}}">
                                    {{$form['text']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="saveSolicitude()"> Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h2>Mis registros</h2>
        <div>
            <button type="button" class="new-registry-btn" data-toggle="modal" data-target="#newRegistryModalForm">
                + Registro
            </button>
            <a class="ml-2 go-to-profile-link" href="/perfil">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person"
                     viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                </svg>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="mb-5">
            @foreach($solicitudes as $application)
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
