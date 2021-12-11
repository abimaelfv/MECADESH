<?php 
  include_once 'Views/Template/header-admin.php';
  // dep($_SESSION['permisosMod']);
?>

<main class="app-content">
      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            <div class="info"><img class="user-img" src="<?= Assets();?>/img/avatar.png">
              <h4><?= ucwords(strtolower(nameCorto($_SESSION['userData']['nombres']).' '.$_SESSION['userData']['apellidos']))?></h4>
              <p><?= ucwords(strtolower($_SESSION['userData']['nombrerol'])) ?></p>
            </div>
            <div class="cover-image"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Timeline</a></li>
              <li class="nav-item"><a class="nav-link" href="#dato-personal" data-toggle="tab">Datos Personales</a></li>
              <li class="nav-item"><a class="nav-link" href="#dato-contacto" data-toggle="tab">Datos de Contacto</a></li>
              <li class="nav-item"><a class="nav-link" href="#dato-fiscal" data-toggle="tab">Datos Fiscales</a></li>
              <li class="nav-item"><a class="nav-link" href="#cambiar-clave" data-toggle="tab">Cambiar Contraseña</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="user-timeline">
              <div class="timeline-post">
                <div class="post-media"><a href="#"><img src="<?= Assets(); ?>/img/avatar.png" height="30px"></a>
                  <div class="content">
                    <h5><a href="#">John Doe</a></h5>
                    <p class="text-muted"><small>2 January at 9:30</small></p>
                  </div>
                </div>
                <div class="post-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <ul class="post-utility">
                  <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
                  <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
                  <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
                </ul>
              </div>
              <div class="timeline-post">
                <div class="post-media"><a href="#"><img src="<?= Assets(); ?>/img/avatar.png" height="30px"></a>
                  <div class="content">
                    <h5><a href="#">John Doe</a></h5>
                    <p class="text-muted"><small>2 January at 9:30</small></p>
                  </div>
                </div>
                <div class="post-content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,	quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <ul class="post-utility">
                  <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
                  <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
                  <li class="comments"><i class="fa fa-fw fa-lg fa-comment-o"></i> 5 Comments</li>
                </ul>
              </div>
            </div>
            <div class="tab-pane fade" id="dato-personal">
              <div class="timeline-post">
                <form id="formDataPersonal" name="formDataPersonal">
                    <div class="post-media">
                    <div class="content d-flex w-100" style="justify-content: space-between;">
                        <h5 class="perfil-tit">DATOS PERSONALES </h5>
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                        <!-- <p class="text-muted"><small>2 January at 9:30</small></p> -->
                    </div>
                    </div>
                    <table class="table table-bordered table-perfil">
                        <tbody>
                            <tr>
                                <td style="width:35%;"><label class="perfil-label" for="txtIdentificacion"><i class="fas fa-address-card"></i> &nbsp; DNI: </label></td>
                                <td><input class="perfil-input" type="text" id="txtIdentificacion" name="txtIdentificacion" value="<?= $_SESSION['userData']['identificacion'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label class="perfil-label" for="txtName"><i class="fas fa-user"></i> &nbsp; Nombres: </label></td>
                                <td><input class="perfil-input valid validTextPerfil" type="text" id="txtName" name="txtName" value="<?= $_SESSION['userData']['nombres'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label class="perfil-label" for="txtApellido"><i class="fas fa-user"></i> &nbsp; Apellidos: </label></td>
                                <td><input class="perfil-input valid validTextPerfil" type="text" id="txtApellido" name="txtApellido" value="<?= $_SESSION['userData']['apellidos'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label class="perfil-label" for="txtProvincia"><i class="fas fa-map-marker-alt"></i> &nbsp; Provincia: </label></td>
                                <td style="padding-top: 4px;"><select class="form-control perfil-input" name="txtProvincia" id="txtProvincia" required>
                                    </select></td>
                            </tr>
                            <tr>
                                <td><label class="perfil-label" for="txtGenero"><i class="fas fa-restroom"></i> &nbsp; Genero: </label></td>
                                <td style="padding-top: 4px;"><select class="form-control perfil-input" name="txtGenero" id="txtGenero" required>
                                    <?php
                                        if ($_SESSION['userData']['genero'] == 'M') { ?>
                                            <option value="M" selected hidden>Masculino</option>
                                        
                                    <?php   }else{  ?>
                                        <option value="F" selected hidden>Femenino</option>
                                    <?php } ?>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="dato-contacto">
              <div class="timeline-post">
                <form id="formDataContacto" name="formDataContacto">
                    <div class="post-media">
                    <div class="content d-flex w-100" style="justify-content: space-between;">
                        <h5 class="perfil-tit">DATOS DE CONTACTO </h5>
                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>
                        <!-- <p class="text-muted"><small>2 January at 9:30</small></p> -->
                    </div>
                    </div>
                    <table class="table table-bordered table-perfil mt-4 mb-3">
                        <tbody>
                            <tr>
                                <td><label class="perfil-label" for="txtTelefono"><i class="fas fa-phone-alt"></i> &nbsp; Teléfono: </label></td>
                                <td><input class="perfil-input validContacto validNumberPerfil" type="text" id="txtTelefono" name="txtTelefono" value="<?= $_SESSION['userData']['telefono'] ?>"></td>
                            </tr>
                            <tr>
                                <td><label class="perfil-label" for="txtEmail"><i class="fas fa-envelope"></i> &nbsp; Email: </label></td>
                                <td><input class="perfil-input validContacto validEmailPerfil" type="email" id="txtEmail" name="txtEmail" value="<?= $_SESSION['userData']['email'] ?>"></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="dato-fiscal">
              <div class="tile user-settings">
                <form id="formDataFiscal" name="formDataFiscal">
                <h4 class="line-head w-100 d-flex justify-content-between">DATOS FISCALES <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button></h4>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label>Identificacion Tributaria</label>
                      <input class="form-control" type="text" id="txtNit" name="txtNit" value="<?= $_SESSION['userData']['nit']?>">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Nombre Fiscal</label>
                      <input class="form-control" type="text" id="txtNombreFiscal" name="txtNombreFiscal" value="<?= $_SESSION['userData']['nombrefiscal']?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label>Dirección Fiscal</label>
                      <input class="form-control" type="text" id="txtDireccionFiscal" name="txtDireccionFiscal" value="<?= $_SESSION['userData']['direccionfiscal']?>">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </form>
              </div>
            </div>
            <div class="tab-pane fade" id="cambiar-clave">
              <div class="tile user-settings">
                <form id="formNewClave" name="formNewClave">
                <h4 class="line-head w-100 d-flex justify-content-between">CAMBIAR CONTRASEÑA <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button></h4>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label for="txtClaveActual"><i class="fas ico-color fa-shield-alt"></i> &nbsp; Contraseña actual</label>
                      <input class="form-control" type="password" id="txtClaveActual" name="txtClaveActual" autocomplete="on">
                    </div>
                    <div class="clearfix"></div>
                  </div> 
                  <div class="row mb-2">
                    <div class="col-md-6 mb-3">
                      <label for="txtClaveNueva" ><i class="fas ico-color fa-key"></i> &nbsp; Nueva contraseña</label>
                      <input class="form-control" type="password" id="txtClaveNueva" name="txtClaveNueva" autocomplete="on">
                    </div>
                    <div class="col-md-6">
                      <label for="txtClaveConfirmar" ><i class="fas ico-color fa-key"></i> &nbsp; Repetir contraseña nueva</label>
                      <input class="form-control" type="password" id="txtClaveConfirmar" name="txtClaveConfirmar" autocomplete="on">
                    </div>
                  </div>    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
<?php include_once 'Views/Template/footer-admin.php' ?>