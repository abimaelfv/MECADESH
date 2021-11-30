<?php

class Fail extends Controllers{
    public function __construct(){
        parent:: __construct();
    }

    public function notFound(){
        // echo 'mensaje desde el controlador';
        $this->views->getView($this,"error"); //llamada instancia views
    }

}

$error = new Fail; // intancia de class error
$error->notFound();

?>