<div class="container block">
    
  <h4>Formulario basico</h4>
  <form role="form">
      <div class="form-group">
        <label class="control-label" for="email-01">Correo electrónico:</label>
        <input class="form-control" id="email-01" placeholder="Correo electrónico" type="text">
      </div>
      <div class="form-group">
        <label class="control-label" for="password-01">Contraseña</label>
        <input class="form-control" id="password-01" placeholder="Contraseña" type="password">
      </div>
      <div class="form-group">
        <label class="control-label" for="file-01">Cargar archivo:</label>
        <input id="file-01" type="file">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox">
          Acepto los términos
        </label>
      </div>
      <div class="form-group">
        <textarea class="form-control" rows="3"></textarea>
      </div>
      <button class="btn btn-primary pull-right" type="submit">Enviar</button>
  </form> 

  <hr>
  
  <h4>Formulario en linea</h4>
  <form class="form-inline" role="form">
      <div class="form-group">
        <label class="sr-only" for="email-02">Correo electrónico:</label>
        <input class="form-control" id="email-02" placeholder="Ingrese su email" type="text">
      </div>
      <div class="form-group">
        <label class="sr-only" for="password-02">Contraseña</label>
        <input class="form-control" id="password-02" placeholder="Ingrese su contraseña" type="password">
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox">
          Recordarme
        </label>
      </div>
      <button class="btn btn-primary" type="submit">Ingresar</button>
  </form>

  <hr>
  
  <h4>Formulario con flexbox</h4>
  <form role="form">
      <div class="form-group row">
        <label class="col-3 col-form-label" for="email-03">Correo electrónico:</label>
        <div class="col-9">
          <input class="form-control" id="email-03" placeholder="Correo electrónico" type="text">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-3 col-form-label" for="password-03">Contraseña:</label>
        <div class="col-9">
          <input class="form-control" id="password-03" placeholder="Contraseña" type="password">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-9">
          <div class="checkbox">
            <label>
              <input type="checkbox">
              Recordarme
            </label>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-9">
          <button class="btn btn-primary pull-right" type="submit">Enviar</button>
        </div>
      </div>
  </form>
    
</div>