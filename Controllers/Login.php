<?php

class Login extends Controllers{
    public function __construct(){

        parent:: __construct();
        
        session_start(); 
        if (isset($_SESSION['session'])) {
            header('location: '.base_url().'/usuarios/perfil');
        }
        
    }

    public function login(){
        // echo 'mensaje desde el controlador';

        $data['page_tag'] = "Login";
        $data['page_title'] = "Login";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        $data['function_js'] = "function-login.js";

        $this->views->getView($this,"login",$data); //llamada instancia views
    }

    public function loginUser(){

        if ($_POST) {

            if (empty($_POST['txtUser']) || empty($_POST['txtClave'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos ingresados.');

            }else{
                $strUser = strtolower(strClean($_POST['txtUser']));
                $strClave = hash("SHA256",$_POST['txtClave']);
                $request = $this->model->loginUser($strUser,$strClave);

                if (empty($request)) {
                    $arrResponse = array('status' => false, 'msg' => 'El usuario o contraseña es Incorrecta.');
                }else{
                    $arrData = $request;

                    if($arrData['status'] == 1){
                        $_SESSION['idUser'] = $arrData['idpersona'];
                        $_SESSION['session'] = true;

                        $arrDataUser = $this->model->sessionData($_SESSION['idUser']);

                        sessionUser($_SESSION['idUser']) == $arrDataUser;
                        // $_SESSION['userData'] = $arrDataUser;

                        $arrResponse = array('status' => true, 'msg' => 'Ok');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Usuario Inactivo, comunicate con la Empresa');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function resetPass(){
        
        if ($_POST) {

            error_reporting(0);
            
            if (empty($_POST['txtEmailReset'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de datos ingresados.');
            }else{
                $token = token();
                $strEmail= strtolower(strClean($_POST['txtEmailReset']));
                $arrData = $this->model->existUserEmail($strEmail);

                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'El usuario no existente.');
                }else{
                    $idpersona = $arrData['idpersona'];
                    $nombreUsuario = $arrData['nombres'].' '.$arrData['apellidos'];

                    $url_recovery = base_url().'/login/reset_clave/'.$strEmail.'/'.$token;
                    $requestUpdate = $this->model->setTokenUser($idpersona,$token);

                    $dataEmail = array('numbreUser' => $nombreUsuario,
                                        'email' => $strEmail,
                                        'asunto' => 'HA OLVIDADO SU CONTRASEÑA',
                                        'url_recovery' => $url_recovery);


                    if($requestUpdate){

                        // enviar correo
                        $sendEmail = sendEmail($dataEmail,'reset_clave');

                        if ($sendEmail) {
                            $arrResponse = array('status' => true, 'msg' => 'Se envio un enlace de reinicio de contraseña a tu email.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realiazar el proceso, intentalo más tarde.');
                        }

                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'No es posible realiazar el proceso, intentalo más tarde.');
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function reset_clave(string $params){

        if (empty($params)) { // validar parametos de GET
            header('Location: '.base_url());
        }else{

            //combertir a aray 
            $arrParams = explode(',',$params);
            $strEmail = strClean($arrParams[0]);
            $strToken = strClean($arrParams[1]);

            $arrResponse = $this->model->existUsuario($strEmail,$strToken);

            if(empty($arrResponse)){
                header("Location: ".base_url());
            }else{
                $data['page_title'] = "Mecadesh";
                $data['vent_name'] = "MECADESH";
                $data['function_js'] = "function-login.js";
        
                $data['idpersona'] = $arrResponse['idpersona'];
                $data['email'] = $strEmail;
                $data['token'] = $strToken;
        
                $this->views->getView($this,"reset_clave",$data);
            }
        }
        die();
    }

    public function setPassword(){
        if ($_POST) {

            if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) || empty($_POST['txtToken']) || empty($_POST['txtClave']) || empty($_POST['txtClave2'])){
                $arrResponse = array('status' => false, 'msg' => 'Error de datos ingresados.');
            }else{
                $intIdPersona = intval($_POST['idUsuario']);
                $strEmail = strClean($_POST['txtEmail']);
                $strToken = strClean($_POST['txtToken']);
                $strClave = $_POST['txtClave'];
                $strClave2 = $_POST['txtClave2'];

                if ($strClave != $strClave2) {
                    $arrResponse = array('status' => false, 'msg' => 'Verifica que las contraseñas sean iguales.');
                }else{
                    $requestExist = $this->model->existUsuario($strEmail,$strToken);

                    if(empty($requestExist)){
                        $arrResponse = array('status' => false, 'msg' => 'Error de datos.');
                    }else{
                        $newPass = hash("SHA256",$strClave);
                        $requestPass = $this->model->UpdatePassword($intIdPersona,$newPass);

                        if ($requestPass) {
                            $arrResponse = array('status' => true, 'msg' => 'Contraseña nueva actualizada con exito.');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'No es posible realizar el proceso, intente más tarde.');
                        }
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    
    
}

?>