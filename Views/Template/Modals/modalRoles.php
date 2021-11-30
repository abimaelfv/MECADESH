<!-- Modal -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
            <div class="tile-body">
              <form id="formRol" name="formRol" >
                <div class="form-group">
                  <label class="nombreRol">Nombre Rol</label>
                  <input class="form-control" type="text" name="nombreRol" id="nombreRol" placeholder="Nombre del Rol">
                </div>
                <div class="form-group">
                  <label class="descripcionRol">Descripcion</label>
                  <textarea class="form-control" name="descripcionRol" id="descripcionRol" rows="2" placeholder="Descripcion"></textarea>
                </div>
                <div class="form-group">
                    <label for="estadoRol">Estado</label>
                    <select class="form-control" name="estadoRol" id="estadoRol" required>
                      <option values="1">Activo</option>
                      <option values="0">Inactivo</option>
                    </select>
                  </div>
                </div>
                <div class="tile-footer">
                <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>