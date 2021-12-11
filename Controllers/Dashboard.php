<?php

class Dashboard extends Controllers{

    public function __construct(){

        parent:: __construct();

        session_start();
        session_regenerate_id(true); // eliminar sesiones
        if (empty($_SESSION['session'])) {
            header('location: '.base_url().'/login');
        }

        getPermisos(1);
    }

    public function dashboard(){
        // echo 'mensaje desde el controlador';

        $data['page_id'] = "A2";
        $data['page_tag'] = "Dashboard";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        $data['function_js'] = "function-dashboard.js";

        $this->views->getView($this,"dashboard",$data); //llamada instancia views
    }


}

?>