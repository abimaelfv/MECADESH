<?php

class Roles extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function roles(){
        // echo 'mensaje desde el controlador';

        $data['page_id'] = "A3";
        $data['page_tag'] = "Roles";
        $data['page_title'] = "Roles Usuario";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        

        $this->views->getView($this,"roles",$data); //llamada instancia views
    }


}

?>