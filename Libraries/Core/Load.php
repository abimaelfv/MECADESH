<?php

    // Load Controladores
    $controller = ucwords($controller); // mayu inicio letra
    $controllerFile = "Controllers/".$controller.".php";
    if(file_exists($controllerFile)){   // validar controlador
        require_once($controllerFile);
        $controller = new $controller(); // instancia

        if (method_exists($controller, $method)) {  // validar existencia de metodos
            $controller->{$method}($parametros);  // llmar metodo de controller
        }else{
            require_once("Controllers/Error.php");
            // echo "No existe metodo del class";
        }
    }else{
        require_once("Controllers/Error.php");
        // echo "No existe class name Controlador";
    }

?>