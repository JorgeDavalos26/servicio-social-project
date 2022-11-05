<div class="container block">

    <h4>Caja sencilla de texto</h4>
    <input class="form-control" placeholder="Area de texto" type="text">
    <br>

    <h4>Cajas para múltiples líneas de texto</h4>
    <textarea class="form-control" placeholder="Área de texto" rows="3"></textarea>
    <br>

    <h4>Casillas de verificación y botones de opción</h4>
    <div class="checkbox">
        <label>
            <input type="checkbox" value="opcion-01"> Opción 1
        </label><br>
        <label>
            <input type="checkbox" value="opcion-02"> Opción 2
        </label><br>
        <label>
            <input type="checkbox" value="opcion-03"> Opción 3
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="radio-01" value="opcion-01" checked="checked"> Opción 1
        </label><br>
        <label>
            <input type="radio" name="radio-01" value="opcion-02" checked="checked"> Opción 2
        </label><br>
        <label>
            <input type="radio" name="radio-01" value="opcion-03" checked="checked"> Opción 3
        </label>
    </div>
    <br>

    <h4>Campos de selección</h4>
    <h6>Normal</h6>
    <select class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
    <h6>Multiple</h6>
    <select multiple class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
    <br>
      
    <h4>Botones</h4>
    <!-- Botón básico -->
    <button type="button" class="btn btn-secondary">Básico</button>
    <!-- Botón de error -->
    <button type="button" class="btn btn-danger">Error</button>
    <!-- Botón primario -->
    <button type="button" class="btn btn-primary">Primario</button>
    <!-- Botón tipo hipervínculo -->
    <button type="button" class="btn btn-link">Hipervínculo</button>
    <br>

    <h4>Tamaños de botones</h4>
    <p>
        <button class="btn btn-secondary btn-lg" type="button">Grande</button>
        <button class="btn btn-primary btn-lg" type="button">Grande</button>
    </p>
    <p>
        <button class="btn btn-secondary" type="button">Básico</button>
        <button class="btn btn-primary" type="button">Básico</button>
    </p>
    <p>
        <button class="btn btn-secondary btn-sm" type="button">Chico</button>
        <button class="btn btn-primary btn-sm" type="button">Chico</button>
    </p>
    <br>

    <h4>Estado activo e inactivo (deshabilitado)</h4>
    <!-- active -->
    <button class="btn btn-secondary active" type="button">Ejemplo</button>
    <button class="btn btn-primary active" type="button">Ejemplo</button>
    <!-- inactive -->
    <button class="btn btn-secondary disabled" type="button">Ejemplo</button>
    <button class="btn btn-primary disabled" type="button">Ejemplo</button>
    <br><br>

    <h4>Grupo de botones</h4>
    <div class="btn-group" role="group" aria-label="...">
        <button type="button" class="btn btn-secondary">Izquierda</button>
        <button type="button" class="btn btn-secondary">Centro</button>
        <button type="button" class="btn btn-secondary">Derecha</button>
    </div>
    <br><br>
      
    <h4>Grupo de botones vertical</h4>
    <div class="btn-group-vertical" role="group" aria-label="...">
        <button type="button" class="btn btn-secondary">Izquierda</button>
        <button type="button" class="btn btn-secondary">Centro</button>
        <button type="button" class="btn btn-secondary">Derecha</button>
    </div>
    <br><br>

    <h4>Grupo de botones justificados</h4>
    <div class="btn-group d-flex" role="group" aria-label="...">
        <button type="button" class="btn btn-secondary">Izquierda</button>
        <button type="button" class="btn btn-secondary">Centro</button>
        <button type="button" class="btn btn-secondary">Derecha</button>
    </div>
    <br>

    <h4>Botones con iconos</h4>
    <!-- Icono del lado izquierdo del botón -->
    <button class="btn btn-secondary" type="button">
        <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-search"></i></span>
        Ejemplo
    </button>
    <!-- Icono del lado derecho del botón -->
    <button class="btn btn-primary" type="button">
        Ejemplo
        <span class="bootstrap-icons" aria-hidden="true"><i class="bi bi-search"></i></span>
    </button>
    
</div>