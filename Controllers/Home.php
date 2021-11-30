<?php

class Home extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function home(){
        // echo 'mensaje desde el controlador';

        $data['page_id'] = "A1";
        $data['page_tag'] = "Home";
        $data['page_title'] = "PAGINA PRINCIPAL";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";
        

        $this->views->getView($this,"home",$data); //llamada instancia views
    }


}

?>