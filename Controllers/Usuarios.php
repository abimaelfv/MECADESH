<?php

class Usuarios extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function usuarios(){
        // echo 'mensaje desde el controlador';

        $data['page_tag'] = "Usuarios";
        $data['page_title'] = "Usuarios";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        
        $this->views->getView($this,"usuarios",$data); //llamada instancia views
    }


}

?>