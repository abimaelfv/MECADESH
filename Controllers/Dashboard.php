<?php

class Dashboard extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function dashboard(){
        // echo 'mensaje desde el controlador';

        $data['page_id'] = "A2";
        $data['page_tag'] = "Dashboard";
        $data['page_title'] = "Dashboard";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        

        $this->views->getView($this,"dashboard",$data); //llamada instancia views
    }


}

?>