<?php
require_once("Config/Config.php");
require_once("Helpers/Helpers.php");


$url = isset($_GET['url'])? $_GET['url'] : 'home/home'; // si no hay direccionamiento

$arrayUrl = explode('/',$url);  // convertir a array el direccionamiento

$controller = $arrayUrl[0];  // pagina controlador
$method = $arrayUrl[0]; // pagina metodo
$parametros = "";  // paramtros

if (!empty($arrayUrl[1])) { // si no hay metodo
    if ($arrayUrl[1] != "") {
        $method = $arrayUrl[1];
    }
}

if (!empty($arrayUrl[2])) {  // si no hay parametros
    if ($arrayUrl[2] != "") {
        for ($i=2; $i < count($arrayUrl); $i++) { 
            $parametros .= $arrayUrl[$i].',';
        }
        $parametros = trim($parametros,','); // quitar ultima coma 
    }
}

// Autocarga de librerias y modelos
require_once("Libraries/Core/Autoload.php");

// Load o carga de Controladores
require_once("Libraries/Core/Load.php");


// echo " <br> controlador: ".$controller;
// echo " <br> metodo: ".$method;
// echo " <br> parametros: ".$parametros;

?>