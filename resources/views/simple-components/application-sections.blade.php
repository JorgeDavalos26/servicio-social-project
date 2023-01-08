
<!-- template -->
<div class="my-5">
    <h4>{{ __('Paperworks') }} {{ $application['level'] }}</h4>
    <div>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            @foreach ($application['courses'] as $course)
                @php
                    $s = $application['level'] . $course
                @endphp
                <a
                    @class([
                        'nav-link',
                        'active' => $course === "Propedéutico",
                    ])
                    id="nav-tab-{{ $s }}" href="#nav-{{ $s }}" data-toggle="tab" role="tab"
                    aria-controls="nav-{{ $s }}"
                    aria-selected="{{ $course === 'Propedéutico' }}">
                    {{ $course }}
                </a>
            @endforeach
        </div>
        <div class="tab-content" id="nav-tabContent">
            @foreach ($application['courses'] as $course)
                @php
                    $s = $application['level'] . $course;
                @endphp
                <div
                    @class([
                        'tab-pane',
                        'fade',
                        'show active' => $course === "Propedéutico",
                    ])
                    id="nav-{{ $s }}" role="tabpanel"
                    aria-labelledby="nav-tab-{{ $s }}">
                    <p>
                        {{ $course }} {{ __('level') }} {{ $application['level'] }}

                        @include('simple-components.application-section', ["level" => $application['level'], $course])
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
