<?php 
  include_once 'Views/Template/header-admin.php';
  getModal('modalRoles',$data);
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
            <div class="tile-body">Roles de usuario</div>
          </div>
        </div>
      </div>
    </main>

<?php include_once 'Views/Template/footer-admin.php' ?>