@extends("templates.main_gobmx_template")

@section("template")

    @vite(['resources/css/solicitude-view.css'])

    <div>
        <h2>Solicitud</h2>
        <div>
            <span>
                {{$solicitude['status']}}
            </span>
            <span>
                {{$solicitude['period']['label']}}
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
                                    class="form-control datepicker"
                                    id="{{$question['id']}}"
                                    type="text"
                                    name="{{$question['backendName']}}"
                                    {!!$question['required'] == 'true' ? 'required' : ''!!}
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
                                        {!!$question['required'] == 'true' ? 'required' : ''!!}
                                        value="{{isset($question['answer']) && $question['answer'] == "true" ? "true" : "false"}}"
                                    /> Sí
                                </label>
                                <label class="boolean-input-label">
                                    <input
                                        class="question-answer-input"
                                        type="radio"
                                        name="{{$question['backendName']}}"
                                        {!!$question['required'] == 'true' ? 'required' : ''!!}
                                        value="{{isset($question['answer']) && $question['answer'] == "true" ? "true" : "false"}}"
                                    /> No
                                </label>
                            </div>
                        @elseif($question["type"] == "file")
                            <input
                                id="{{$question['id']}}"
                                class="question-answer-input form-control"
                                type="file"
                                name="{{$question['backendName']}}"
                                {!!$question['required'] == 'true' ? 'required' : ''!!}
                                value="{{isset($question['answer']) ? $question['answer']['value'] : null}}"
                            />
                        @else
                            <input id="{{$question['id']}}"
                                   class="question-answer-input form-control"
                                   type="{{$question['type'] == 'string' ? 'text' : 'number'}}"
                                   name="{{$question['backendName']}}"
                                   {!!$question['required'] == 'true' ? 'required' : ''!!}
                                   value="{{isset($question['answer']) ? $question['answer']['value'] : ""}}"/>
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

@section("script")

    @vite(['resources/js/solicitude_view.js'])

    <script type="text/javascript">
        $(document).ready(function () {
            console.log("$(document).ready has been called!");
            $.datepicker.regional.es = {
                closeText: 'Cerrar',
                prevText: 'Ant',
                nextText: 'Sig',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi&eacute;rcoles', 'Jueves', 'Viernes', 'S&aacute;bado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'S&aacute;b'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };

            $.datepicker.setDefaults($.datepicker.regional.es);

            $(".datepicker").each((_, element) => {
                element.datepicker();
            })
        });
    </script>

@endsection
