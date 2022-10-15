<nav class="navbar navbar-expand-md navbar-dark bg-light navbar-fixed-top sub-navbar">
    <div class="container">
        
        <button type="button" class="navbar-toggler" style="top: 10px" data-toggle="collapse" data-target="#subNavBarDropdown" 
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Conmutar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- <a class="navbar-brand sub-navbar" href="/">Centro de Enseñanza Técnica Industrial</a> --}}
        <a class="navbar-brand sub-navbar" href="/">CETI</a>
        
        <div  id="subNavBarDropdown" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link subnav-link" href="inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link subnav-link" href="registro">Registrarme</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdownMenuLink" class="nav-link subnav-link dropdown-toggle" 
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cuenta
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="">Ver perfil</a>
                        <a class="dropdown-item" href="">Trámites</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="logout()">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
        
    </div>
</nav>