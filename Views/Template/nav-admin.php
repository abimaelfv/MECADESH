  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  
  <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= Assets(); ?>/img/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres'] ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol'] ?></p>
        </div>
      </div>
      <ul class="app-menu">
          <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/usuarios/perfil">
            <i class="app-menu__icon fas fa-user-circle medio"></i>
              <span class="app-menu__label">Mi perfil</span>
            </a>
          </li>
        <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
          <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
              <i class="app-menu__icon fas fa-tachometer-alt"></i>
              <span class="app-menu__label">Dashboard</span>
            </a>
          </li>
        <?php } if(!empty($_SESSION['permisos'][2]['r'])){  ?>
          <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-users"></i>
                <span class="app-menu__label">Usuarios</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon fa fa-circle-o"></i> Roles</a></li>
              </ul>
          </li>
        <?php } if(!empty($_SESSION['permisos'][3]['r'])){ ?>
          <li>
              <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
                  <i class="app-menu__icon fas fa-user" aria-hidden="true"></i>
                  <span class="app-menu__label">Clientes</span>
              </a>
          </li>
        <?php } if(!empty($_SESSION['permisos'][4]['r']) || !empty($_SESSION['permisos'][6]['r'])){ ?>
          <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-box-open"></i><span class="app-menu__label">Tienda</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if(!empty($_SESSION['permisos'][4]['r'])){  ?>
                  <li><a class="treeview-item" href="<?= base_url(); ?>/productos"><i class="icon fa fa-circle-o"></i> Productos</a></li>
                <?php } if(!empty($_SESSION['permisos'][6]['r'])){  ?>
                  <li><a class="treeview-item" href="<?= base_url(); ?>/caregorias"><i class="icon fa fa-circle-o"></i> Categorias</a></li>
                <?php } ?>
                <li><a class="treeview-item" href="<?= base_url(); ?>/entradas"><i class="icon fa fa-circle-o"></i> Entradas</a></li>
                <li><a class="treeview-item" href="<?= base_url(); ?>/salidas"><i class="icon fa fa-circle-o"></i> Salidas</a></li>
              </ul>
          </li>
        <?php } if(!empty($_SESSION['permisos'][5]['r'])){ ?>
        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
                <i class="app-menu__icon fa fa-shopping-cart v5" aria-hidden="true"></i>
                <span class="app-menu__label">Pedidos</span>
            </a>
        </li>
        <?php } ?>
        <li><a class="app-menu__item" href="<?= base_url(); ?>/logout"><i class="app-menu__icon fas fa-power-off"></i><span class="app-menu__label">Cerrar sesión</span></a></li>
      </ul>
    </aside>