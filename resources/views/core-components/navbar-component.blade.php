
<!-- template -->
<nav class="navbar navbar-expand-md navbar-dark bg-light navbar-fixed-top sub-navbar">
    <div class="container">

        <button type="button" class="navbar-toggler" style="top: 10px; z-index: 10000;" data-toggle="collapse" data-target="#subNavBarDropdown"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label={{ __('Switch navigation') }}>
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand sub-navbar" style="margin-right:0px !important; margin-top:18px !important;" href="/">
            <span>
                <img style="height: 30px; width: 30px; margin-right: 10px;" src="{{ Vite::asset('resources/images/ceti.webp') }}" alt="">
                    Centro de Enseñanza Técnica Industrial
            </span>
        </a>

        <div  id="subNavBarDropdown" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                @env('local')
                    <li class="nav-item">
                        <a class="nav-link subnav-link" href="/gobmx">Gobmx Examples</a>
                    </li>
                @endenv
                @guest
                    <li class="nav-item">
                        <a class="nav-link subnav-link" href="/registro">{{ __('Get signed up') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link subnav-link" href="/ingreso">{{ __('Log in') }}</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link subnav-link" href="/inicio">{{ __('Home') }}</a>
                    </li>
                    <li class="nav-item dropdown">
                        <li class="nav-item dropdown">
                        <a id="navbarDropdownMenuLink" class="nav-link subnav-link dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Account') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/perfil">{{ __('Profile') }}</a>
                            <a class="dropdown-item" href="/inicio">{{ __('Paperworks') }}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" onclick="logout()">{{ __('Close session') }}</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>

    </div>
</nav>
