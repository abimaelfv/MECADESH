<!-- Modal -->
<div class="modal fade" id="modalFormCliente" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formCliente" name="formCliente" class="form-horizontal">
            <input type="hidden" name="idUsuario" id="idUsuario" value="">
            <p class="text-primary" id="txtMensaje">Todos los campos son obligatorios.</p>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="txtIdentificacion">DNI</label>
                    <input class="form-control valid validNumber" type="text" name="txtIdentificacion" id="txtIdentificacion" placeholder="Documento de Identidad" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="txtName">Nombres</label>
                    <input class="form-control valid validText" type="text" name="txtName" id="txtName" placeholder="Nombre Completo" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="txtApellido">Apellidos</label>
                    <input class="form-control valid validText" type="text" name="txtApellido" id="txtApellido" placeholder="Apellido Completo" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="txtEmail">Correo</label>
                    <input class="form-control valid validEmail" type="email" name="txtEmail" id="txtEmail" placeholder="Correo Electronico" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="txtTelefono">Teléfono</label>
                    <input class="form-control valid validNumber" type="text" name="txtTelefono" id="txtTelefono" placeholder="Número de Telefono" required onKeypress="return controlTag(event);">
                </div>
                <div class="form-group col-md-4">
                    <label for="txtProvincia">Provincia</label>
                    <select class="form-control" data-live-search="true" name="txtProvincia" id="txtProvincia" required>
                    </select>
                </div>
            </div>
            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="txtGenero">Genero</label>
                    <select class="form-control selectpicker" name="txtGenero" id="txtGenero" required>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
            </div>
            <p class="text-primary" id="txtMensaje">Datos Fiscales.</p>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Identificacion Tributaria</label>
                    <input class="form-control" type="text" id="txtNit" name="txtNit" value="<?= $_SESSION['userData']['nit']?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Nombre Fiscal</label>
                    <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" value="<?= $_SESSION['userData']['nombrefiscal']?>">
                </div>
            </div>

            <div class="nuevorow"></div>

            <div class="tile-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
                &nbsp;&nbsp;&nbsp;<button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>
            </div>
        </form>

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-button">
            <tbody>
                <tr>
                    <td>Identificasion:</td>
                    <td id="celIdentificacion">56235412</td>
                </tr>
                <tr>
                    <td>Nombres:</td>
                    <td id="celNombre">Abimael</td>
                </tr>
                <tr>
                    <td>Apellidos:</td>
                    <td id="celApellido">Fernadez Ventura</td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td id="celTelefono">215463258</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td id="celEmail">29abimael@gmail.com</td>
                </tr>
                <tr>
                    <td>Provincia:</td>
                    <td id="celProvincia">Huanuco</td>
                </tr>
                <tr>
                    <td>Genero:</td>
                    <td id="celGenero">M</td>
                </tr>
                <tr>
                    <td>Tipo Usuario:</td>
                    <td id="celTipoUsuario">Administrador</td>
                </tr>
                <tr>
                    <td>Estado:</td>
                    <td id="celEstado">Activo</td>
                </tr>
                <tr>
                    <td>Fecha de registro:</td>
                    <td id="celFechaRegistro">2020/11/15 12:25:20</td>
                </tr>
            </tbody>
        </table>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cerrar</button>
        </div>
    </div>
  </div>
</div>