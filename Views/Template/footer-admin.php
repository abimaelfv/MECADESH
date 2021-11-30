    <!-- Essential javascripts for application to work-->
    <script src="<?= Assets(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= Assets(); ?>/js/popper.min.js"></script>
    <script src="<?= Assets(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= Assets(); ?>/js/main.js"></script>
    <script src="<?= Assets(); ?>/js/function-admin.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= Assets(); ?>/js/plugins/pace.min.js"></script>

    <?php
    switch ($data['page_tag']) {
        case 'Roles':
            ?>  <script src="<?= Assets(); ?>/js/function-roles.js"></script> <?php
            break;
        case 'Usuarios':
            ?>  <script src="<?= Assets(); ?>/js/function-usuarios.js"></script> <?php
            break;
        default:
            # code...
            break;
    }
    ?>
    
    
    </body>
</html>