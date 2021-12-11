<?php

class Usuarios extends Controllers{
    public function __construct(){
        parent:: __construct();
        
        session_start();
        session_regenerate_id(true);
        if (empty($_SESSION['session'])) {
            header('location: '.base_url().'/login');
        }
        
        getPermisos(2);
    }

    public function usuarios(){
        // echo 'mensaje desde el controlador';
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location: ".base_url().'/usuarios/perfil');

        }else{
            $data['page_tag'] = "Usuarios";
            $data['page_title'] = "Usuarios";
            $data['page_name'] = "MECADESH";
            $data['vent_name'] = "MECADESH";
            $data['function_js'] = "function-usuarios.js";
            
            $this->views->getView($this,"usuarios",$data); //llamada instancia views
        }
    }



    public function getUsuarios(){
        if ($_SESSION['permisosMod']['r']) {  // permiso ver
        
            $arrData = $this->model->selectUsuarios();
            
            for ($i=0; $i < count($arrData); $i++) {
                $btnView = "";
                $btnEdit = "";
                $btnDelete = "";

                if($arrData[$i]['status'] == 1)
                {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                }else{
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                    if($_SESSION['permisosMod']['r']){
                        $btnView = '<button class="btn btn-info btn-sm btnViewUsuario" us="'.$arrData[$i]['idpersona'].'" title="Ver usuario"><i class="far fa-eye"></i></button>';
                    }

                    if($_SESSION['permisosMod']['u']){
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1)){
                            $btnEdit = '<button class="btn btn-primary btn-sm btnEditUsuario" us="'.$arrData[$i]['idpersona'].'" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';
                        }else{
                            $btnEdit = '<button class="btn btn-secondary btn-sm" disabled><i class="fas fa-pencil-alt"></i></button>';  
                        }
                    }

                    if($_SESSION['permisosMod']['d']){
                        if (($_SESSION['idUser'] == 1 and $_SESSION['userData']['idrol'] == 1) || ($_SESSION['userData']['idrol'] == 1 and $arrData[$i]['idrol'] != 1) and ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])){
                            $btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" us="'.$arrData[$i]['idpersona'].'" title="Eliminar Usuario"><i class="far fa-trash-alt"></i></button>';
                        }else{
                            $btnDelete = '<button class="btn btn-secondary btn-sm" disabled><i class="far fa-trash-alt"></i></button>';
                        }
                    }

                $arrData[$i]['options'] = '<div class="text-center">'.$btnView. ' '.$btnEdit.' '.$btnDelete.'</div>';
            }
        
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUsuario($idpersona){
        if ($_SESSION['permisosMod']['r']) {  // permiso ver
        
            $idusuario = intval($idpersona);

            if ($idusuario > 0) {
                $arrData = $this->model->selectUsuario($idusuario);
                
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }

                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    public function setUsuario(){

        if ($_POST) {

            if (empty($_POST['txtIdentificacion']) || empty($_POST['txtRolid']) || empty($_POST['txtName']) || empty($_POST['txtApellido']) || empty($_POST['txtEmail']) || empty($_POST['txtTelefono']) || empty($_POST['txtProvincia']) || empty($_POST['txtGenero'])) {
                $arrData = array("status" => false, "msg" => 'Datos Incorrectos');

            }else{

                $idUsuario = intval($_POST['idUsuario']);
                $strIdentificacion = strClean($_POST["txtIdentificacion"]);
                $intRolid = intval(strClean($_POST["txtRolid"]));
                $strNombre = strClean($_POST["txtName"]);
                $strApellido = strClean($_POST["txtApellido"]);
                $strEmail = strClean($_POST["txtEmail"]);
                $intTelefono = intval(strClean($_POST["txtTelefono"]));
                $strProvincia = strClean($_POST["txtProvincia"]);
                $strGenero = strClean($_POST["txtGenero"]);
                $request_user = "";

                if ($idUsuario == 0) {

                    $option = 1;
                    $strclave = hash("SHA256", $_POST['txtIdentificacion']);

                    if ($_SESSION['permisosMod']['w']) {  // permiso escritura
                        $request_user = $this->model->insertUsuario(
                            $strIdentificacion,
                            $intRolid,
                            $strNombre,
                            $strApellido, 
                            $intTelefono,
                            $strEmail,
                            $strProvincia,
                            $strGenero,
                            $strclave
                        );
                    }
                    
                }else{

                    $option = 2;
                    $intEstado = intval(strClean($_POST["listStatus"]));
                    $strclave = empty($_POST['txtClave']) ? "" : hash("SHA256", $_POST['txtClave']);

                    if ($_SESSION['permisosMod']['u']) {  // permiso actualizar
                        $request_user = $this->model->updateUsuario(
                            $idUsuario,
                            $strIdentificacion,
                            $intRolid,
                            $strNombre,
                            $strApellido, 
                            $intTelefono,
                            $strEmail,
                            $strProvincia,
                            $strGenero,
                            $intEstado,
                            $strclave
                        );
                    }
                }
               


                if(intval($request_user) > 0 ){

                    if ($option == 1) { // insert
                        $arrData = array("status" => true, "msg" => 'Datos guardados correctamente.');
                    }else{  // update
                        $arrData = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                    }
                    
                }else if($request_user == 'existIdent'){
                    $arrData = array("status" => false, "msg" => 'La identificasion ya existe, ingrese otro.');
                
                }else if($request_user == 'existEmail'){
                    $arrData = array("status" => false, "msg" => 'El email ya existe, ingrese otro.');
                
                }else{
                    $arrData = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
               
            }
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);

        }
        die();
    }

    public function delUsuario()
    {
        if($_POST){
            if ($_SESSION['permisosMod']['d']) {  // permiso eliminar
                $intId = intval($_POST['idUsuario']);
                $requestDelete = $this->model->deleteUsuario($intId);

                if($requestDelete){
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Usuario');
                
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Usuario.');
                }
                usleep(100000);
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    // SECCION PERFIL ========================================================
    public function perfil(){

        $data['page_tag'] = "Perfil";
        $data['page_title'] = "Perfil";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        $data['function_js'] = "function-perfil.js";
        
        $this->views->getView($this,"perfil",$data); //llamada instancia views
        
    }

    public function setPerfil(){
        if ($_POST) {

            if (empty($_SESSION['idUser']) || empty($_POST['txtIdentificacion']) || empty($_POST['txtName']) || empty($_POST['txtApellido']) || empty($_POST['txtProvincia']) || empty($_POST['txtGenero'])) {
                $arrData = array("status" => false, "msg" => 'Datos Incorrectos');

            }else{
                $idUsuario = intval($_SESSION['idUser']);
                $strIdentificacion = strClean($_POST["txtIdentificacion"]);
                $strNombre = strClean($_POST["txtName"]);
                $strApellido = strClean($_POST["txtApellido"]);
                $strProvincia = strClean($_POST["txtProvincia"]);
                $strGenero = strClean($_POST["txtGenero"]);


                $request_user = $this->model->updatePerfil(
                    $idUsuario,
                    $strIdentificacion,
                    $strNombre,
                    $strApellido, 
                    $strProvincia,
                    $strGenero
                );

                if(intval($request_user) > 0 ){

                    sessionUser($_SESSION['idUser']); //actuaizar userData
                    $arrData = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                    
                }else if($request_user == 'existIdent'){
                    $arrData = array("status" => false, "msg" => 'La identificasion ya existe, ingrese otro.');
                
                }else{
                    $arrData = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }

            }
            usleep(100000);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function setContacto(){
        if ($_POST) {

            if (empty($_SESSION['idUser']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail'])) {
                $arrData = array("status" => false, "msg" => 'Datos Incorrectos');

            }else{
                $idUsuario = intval($_SESSION['idUser']);
                $strEmail = strClean($_POST["txtEmail"]);
                $intTelefono = intval(strClean($_POST["txtTelefono"]));

                $request_user = $this->model->updateContacto(
                    $idUsuario,
                    $intTelefono,
                    $strEmail,
                );

                if(intval($request_user) > 0 ){

                    sessionUser($_SESSION['idUser']); //actuaizar userData
                    $arrData = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                    
                }else if($request_user == 'existEmail'){
                    $arrData = array("status" => false, "msg" => 'El email ya existe, ingrese otro.');
                
                }else{
                    $arrData = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            usleep(100000);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function setClavePerfil(){
        
        if($_POST){

            if(empty($_SESSION['idUser']) || empty($_POST['txtClaveActual']) || empty($_POST['txtClaveNueva']) || empty($_POST['txtClaveConfirmar'])){
                $arrResponse = array('status' => false, 'msg' => 'Error de datos ingresados.');
            
            }else{

                $idUsuario = intval($_SESSION['idUser']);
                $strActual =  $_POST['txtClaveActual'];
                $strClave = $_POST['txtClaveNueva'];
                $strClave2 = $_POST['txtClaveConfirmar'];

                if ($strClave != $strClave2) {
                    $arrResponse = array('status' => false, 'msg' => 'Verifica que las contraseñas nuevas sean iguales.');
                
                }else{
                    $confirmPass = hash("SHA256",$strActual);
                    
                    $request = $this->model->confirmarClave($idUsuario,$confirmPass);

                    if(empty($request)){
                        $arrResponse = array('status' => false, 'msg' => 'La contraseña actual es incorrecto.');
                    }else{
                        $newPass = hash("SHA256",$strClave);
                        $requestPass = $this->model->UpdatePassword($idUsuario,$newPass);

                        if ($requestPass) {
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña nueva actualizada con exito.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.');
                        }
                    }
                }
            }
            usleep(100000);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE); 
        }
        die();
    }

    public function updateDataFiscal(){
        if ($_POST) {

            if (empty($_SESSION['idUser']) || empty($_POST['txtNit']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDireccionFiscal'])) {
                $arrData = array("status" => false, "msg" => 'Datos Incorrectos');

            }else{
                $idUsuario = intval($_SESSION['idUser']);
                $strNit = strClean($_POST["txtNit"]);
                $strNombreFiscal = strClean($_POST["txtNombreFiscal"]);
                $strDireccionFiscal = strClean($_POST["txtDireccionFiscal"]);

                $request_user = $this->model->updateDataFiscal(
                    $idUsuario,
                    $strNit,
                    $strNombreFiscal,
                    $strDireccionFiscal
                );

                if(intval($request_user) > 0 ){

                    sessionUser($_SESSION['idUser']); //actuaizar userData
                    $arrData = array("status" => true, "msg" => 'Datos actualizados correctamente.');
                    
                }else{
                    $arrData = array("status" => false, "msg" => 'No es posible realizar el proceso, intente más tarde.');
                }
            }
            usleep(100000);
            echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    


}

?>