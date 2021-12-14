<?php

class Clientes extends Controllers{
    public function __construct(){
        parent:: __construct();
        
        session_start();
        session_regenerate_id(true);
        if (empty($_SESSION['session'])) {
            header('location: '.base_url().'/login');
        }
        
        getPermisos(3);
    }

    public function clientes(){
        // echo 'mensaje desde el controlador';
        if(empty($_SESSION['permisosMod']['r'])){
            header("Location: ".base_url().'/usuarios/perfil');

        }else{
            $data['page_tag'] = "Clientes";
            $data['page_title'] = "Clientes";
            $data['page_name'] = "MECADESH";
            $data['vent_name'] = "MECADESH";
            $data['function_js'] = "function-clientes.js";
            
            $this->views->getView($this,"clientes",$data);
        }
    }

}

?>