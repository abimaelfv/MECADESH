<?php 
  include_once 'Views/Template/header-admin.php';
  getModal('modalUsuarios',$data);
?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1>
            <i class="fas fa-user-tag"></i> <?= $data['page_title'] ?>
            <button class="btn btn-primary btn-sm" type="button"  onclick="openModal();"> Nuevo</button>
          </h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_tag'] ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tableUsuarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRES</th>
                                <th>APELLIDOS</th>
                                <th>EMAIL</th>
                                <th>TELÉFONO</th>
                                <th>ROL</th>
                                <th>STATUS</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>Carlos</td>
                            <td>Fernadez Ventura</td>
                            <td>29abimael@gmail.com</td>
                            <td>925257563</td>
                            <td>Admin</td>
                            <td>Activo</td>
                            <td></td>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </main>

<?php include_once 'Views/Template/footer-admin.php' ?>