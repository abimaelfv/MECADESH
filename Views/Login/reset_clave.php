<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Mecanica mecadesh, Encargada de reparacion y venta de repuestos de vehiculos menores.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ABIMAEL FV">
    <meta name="theme-color" content="#009688">
    <link rel="shortcut icon" href="<?= Assets(); ?>/img/title.ico">
    <title><?= $data['vent_name'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= Assets(); ?>/css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" >
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo log-title">
        <h1>Mecadesh</h1>
      </div>
      <div class="login-box flipped">
      <div id="divLoading">
          <div>
            <img src="<?= Assets(); ?>/img/loading.svg" alt="Loading">
          </div>
        </div>
        <form id="newPass-form" name="newPass-form" class="forget-form" action="">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?= $data['idpersona']?>">
            <input type="hidden" id="txtEmail" name="txtEmail" value="<?= $data['email']?>">
            <input type="hidden" id="txtToken" name="txtToken" value="<?= $data['token']?>">
          <h3 class="login-head"><i class="fas fa-key"></i> NUEVA CONTRASEÑA</h3>
          <div class="form-group">
            <input class="form-control" type="password" id="txtClave" name="txtClave" placeholder="Nueva contraseña">
          </div>
          <div class="form-group">
            <input class="form-control" type="password" id="txtClave2" name="txtClave2" placeholder="Confirmar contraseña">
          </div>
          <div class="form-group">
            <div class="utility">
            </div>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>REINICIAR</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="<?= base_url(); ?>/login"><i class="fa fa-angle-left fa-fw"></i> Iniciar sessión</a></p>
          </div>
        </form>
      </div>
    </section>

    <script> const base_url = "<?= base_url(); ?>";</script>
    <!-- Essential javascripts for application to work-->
    <script src="<?= Assets(); ?>/js/plugins/jquery-3.3.1.min.js"></script>
    <script src="<?= Assets(); ?>/js/plugins/popper.min.js"></script>
    <script src="<?= Assets(); ?>/js/plugins/bootstrap.min.js"></script>
    <script src="<?= Assets(); ?>js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= Assets(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= Assets(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= Assets(); ?>/js/function-admin.js"></script>
    <script src="<?= Assets(); ?>/js/<?= $data['function_js'] ?>"></script>

  </body>
</html>