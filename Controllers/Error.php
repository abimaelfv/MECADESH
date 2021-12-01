<?php

class Fail extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function notFound(){

        $data['page_tag'] = "Error";
        $data['page_title'] = "Error";
        $data['page_name'] = "MECADESH";
        $data['vent_name'] = "MECADESH";

        // echo 'mensaje desde el controlador';
        $this->views->getView($this,"error",$data); //llamada instancia views
    }

}

$error = new Fail; // intancia de class error
$error->notFound();

?>