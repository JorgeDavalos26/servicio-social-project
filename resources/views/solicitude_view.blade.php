@extends("templates.main_gobmx_template")

@section("script")

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
            <form>
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
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
