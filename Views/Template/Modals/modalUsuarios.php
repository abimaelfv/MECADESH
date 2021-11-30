<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" >
            <input type="hidden" name="idUsuario" id="idUsuario" value="">
            <p class="text-primary">Todos los campos son obligatorios.</p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="DNI">DNI</label>
                    <input class="form-control" type="text" name="DNI" id="DNI" placeholder="Documento de Identidad" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="rolID">Tipo de Usuario</label>
                    <select class="form-control" name="rolID" id="rolID" required>
                        <option values="1">Admin</option>
                        <option values="0">Cajero</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombres</label>
                    <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre Completo" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellido">Apellidos</label>
                    <input class="form-control" type="text" name="apellido" id="apellido" placeholder="Apellido Completo" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="correo">Correo</label>
                    <input class="form-control" type="text" name="correo" id="correo" placeholder="Correo Electronico" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input class="form-control" type="text" name="telefono" id="telefono" placeholder="Número de Telefono" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="provincia">Provincia</label>
                    <select class="form-control" name="provincia" id="provincia" required>
                        <option values="1">Huanuco</option>
                        <option values="0">Lima</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="genero">Genero</label>
                    <select class="form-control" name="genero" id="genero" required>
                        <option values="1">Masculino</option>
                        <option values="0">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="tile-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                &nbsp;&nbsp;&nbsp;<button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>