<?php

class Roles extends Controllers{
    public function __construct(){
        parent:: __construct();

		session_start();
		session_regenerate_id(true);
        if (empty($_SESSION['session'])) {
            header('location: '.base_url().'/login');
        }

		getPermisos(2);
    }

    public function roles(){
        // echo 'mensaje desde el controlador';
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location: ".base_url().'/usuarios/perfil');

        }else{
			$data['page_id'] = "A3";
			$data['page_tag'] = "Roles";
			$data['page_title'] = "Roles Usuario";
			$data['page_name'] = "MECADESH";
			$data['vent_name'] = "MECADESH";
			$data['function_js'] = "function-roles.js";

			$this->views->getView($this,"roles",$data); //llamada instancia views
		}  
    }

    public function getRoles()
	{				
		if ($_SESSION['permisosMod']['r']) {  // permiso ver
			$btnView = "";
			$btnEdit = "";
			$btnDelete = "";
			
			$arrData = $this->model->selectRoles();

			for ($i=0; $i < count($arrData); $i++) {


				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

					if($_SESSION['permisosMod']['r']){
						
					}

					if($_SESSION['permisosMod']['u']){
						$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['idrol'].'" title="Permisos"><i class="fas fa-key"></i></button>';
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" rl="'.$arrData[$i]['idrol'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
					}

					if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['idrol'].'" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
					}

				$arrData[$i]['options'] = '<div class="text-center">'.$btnView. ' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			
		}
		die();
	}

	public function getRol($idrol)
	{
		if ($_SESSION['permisosMod']['r']) {  // permiso ver
			$intIdrol = intval(strClean($idrol));
			if($intIdrol > 0)
			{
				$arrData = $this->model->selectRol($intIdrol);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	public function setRol(){
		
		$intIdrol = intval($_POST['idRol']);
		$strRol =  strClean($_POST['txtNombre']);
		$strDescipcion = strClean($_POST['txtDescripcion']);
		$intStatus = intval($_POST['listStatus']);
		$request_rol = "";

		if($intIdrol == 0)
		{
			if ($_SESSION['permisosMod']['w']) {  // permiso escribir
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescipcion,$intStatus);
			}
			$option = 1;
		}else{
			if ($_SESSION['permisosMod']['u']) {  // permiso actualizar
				//Actualizar
				$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
			}
			$option = 2;
		}

		if(intval($request_rol) > 0 )
		{
			if($option == 1)
			{
				$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
			}else{
				$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
			}
		}else if($request_rol == 'exist'){
			
			$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
		}else{
			$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		die();
	}

	public function delRol(){

		if($_POST){

			if ($_SESSION['permisosMod']['d']) {  // permiso eliminar
				$intIdrol = intval($_POST['idrol']);
				$requestDelete = $this->model->deleteRol($intIdrol);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				usleep(100000);
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
	}

	
}

?>