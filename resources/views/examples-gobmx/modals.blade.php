<div class="container block">

    <h4>Modales</h4>
    <div class="modal" tabindex="1" id="foo">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Este es un titulo de ejemplo en el modal-title</h4>
            </div>
            <div class="modal-body">
              <p>Este es un texto de ejemplo en el modal-body</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#foo">
      Abrir ventana modal mediante HTML attributes
    </button>

    <script>
      let openModal = () => {
        $('#foo').modal()
      }
    </script>

    <button type="button" class="btn btn-primary" onclick="openModal()">
      Abrir ventana modal mediante Javascript/JQuery
    </button>

</div>