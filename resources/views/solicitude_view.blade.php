@extends("templates.main_gobmx_template")

@section("script")

    @vite(['resources/js/solicitude_view.js'])

@endsection

@section("template")

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
                        <input id="{{$question['id']}}"
                               class="question-answer-input form-control"
                               type="{{$question['type'] == 'string' ? 'text' : 'number'}}"
                               name="{{$question['backendName']}}"
                               value="{{isset($question['answer']) ? $question['answer']['value'] : null}}"/>
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
