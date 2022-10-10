@extends("templates.gobmx_template")

@section("content")

    <h2>Panel principal de trámites</h1>
    <br><br>

    <?php 

        $levels = [
            [
                "name" => "Tecnólogo",
                "type" => [
                    [
                        "name" => "Propedéutico",
                    ],
                    [
                        "name" => "Nivelación"
                    ],
                ]
            ],
            [
                "name" => "Ingeniería",
                "type" => [
                    [
                        "name" => "Propedéutico",
                    ],
                    [
                        "name" => "Nivelación"
                    ],
                ]
            ],
        ];

    ?>

    <div class="container">

        @foreach ($levels as $level)

            <div class="my-5">

                <h4>Trámites {{ $level['name'] }}</h4>
                <div>
                    <p>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            
                            @foreach ($level['type'] as $type)

                                <?php 
                                    if($type['name'] === "Propedéutico") {
                                        $activeState = true;
                                    }
                                    else {
                                        $activeState = false;
                                    }
                                ?>

                                <a class="nav-link {{ $activeState ? "active" : "" }}" 
                                    id="nav-tab-{{ $level['name'] }}{{ $type['name'] }}" data-toggle="tab" 
                                    href="#nav-{{ $level['name'] }}{{ $type['name'] }}" role="tab" 
                                    aria-controls="nav-{{ $level['name'] }}{{ $type['name'] }}" 
                                    aria-selected="{{ $activeState }}">{{ $type['name'] }}</a>

                            @endforeach

                        </div>
                    </p>
                    <div class="tab-content" id="nav-tabContent">

                        @foreach ($level['type'] as $type)

                            <?php 
                                if($type['name'] === "Propedéutico") {
                                    $activeState = true;
                                }
                                else {
                                    $activeState = false;
                                }
                            ?>

                            <div class="tab-pane fade {{ $activeState ? "show active" : "" }}" 
                                id="nav-{{ $level['name'] }}{{ $type['name'] }}" role="tabpanel" 
                                aria-labelledby="nav-tab-{{ $level['name'] }}{{ $type['name'] }}">
                                <p>
                                    {{ $type['name'] }} nivel {{ $level['name'] }}
                                </p>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        @endforeach

    </div>

@endsection