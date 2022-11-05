
<!-- styles -->
@vite(['resources/css/topbar-environment.css'])

<!-- template -->
@env(['local', 'staging'])
    <div style="height: 58px; background: #235B4E"></div>
    @env('local')
    <div class="topbar-development">
        <span>
            Development mode
        </span>
    </div>
    @endenv
    @env('staging')
    <div class="topbar-testing">
        <span>
            Staging mode
        </span>
    </div>
    @endenv
@endenv
@env(['production'])
    <br><br>
@endenv