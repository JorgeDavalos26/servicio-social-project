@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/solicitude_view.js'])

@endsection

@section("template")

    @vite(['resources/css/solicitude-view.css'])

    <div>
        <h2>Solicitud</h2>
        <div>
            <span>
                {{$solicitude['status']}}
            </span>
            <span>
                {{$solicitude['periodLabel']}}
            </span>
            <form id="solicitude_form">
                @foreach($solicitude['questions'] as $question)
                    <div class="mt-5">
                        <label for="{{$question['id']}}"
                               class="question-answer-label control-label">
                            {{$question['frontendName']}}
                        </label>
                        @if($question["type"] == "datetime")
                            <div class="form-group datepicker-group">
                                <input
                                    class="form-control"
                                    id="{{$question['id']}}"
                                    type="text"
                                    name="{{$question['backendName']}}"
                                    value="{{isset($question['answer']) ? $question['answer']['value'] : null}}"/>
                                <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-calendar"></i></span>
                            </div>
                        @elseif($question["type"] == "boolean")
                            <div class="d-flex justify-content-around">
                                <label class="boolean-input-label">
                                    <input
                                        class="question-answer-input"
                                        type="radio"
                                        name="{{$question['backendName']}}"
                                        value="{{isset($question['answer']) && $question['answer'] == "true" ? "true" : "false"}}"
                                    /> Sí
                                </label>
                                <label class="boolean-input-label">
                                    <input
                                        class="question-answer-input"
                                        type="radio"
                                        name="{{$question['backendName']}}"
                                        value="{{isset($question['answer']) && $question['answer'] == "true" ? "true" : "false"}}"
                                    /> No
                                </label>
                            </div>
                        @else
                            <input id="{{$question['id']}}"
                                   class="question-answer-input form-control"
                                   type="{{$question['type'] == 'string' ? 'text' : 'number'}}"
                                   name="{{$question['backendName']}}"
                                   value="{{isset($question['answer']) ? $question['answer']['value'] : null}}"/>
                        @endif
                    </div>
                @endforeach
                <div class="my-5">
                    <button class="mr-4 btn btn-secondary">
                        Cancelar
                    </button>
                    <input type="submit" class="btn btn-primary" value="Guardar"/>
                </div>
            </form>
        </div>
    </div>

@endsection
