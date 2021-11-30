<?php

class Views{

    function getView($nom_controller,$nom_view,$data=""){

        $nom_controller = get_class($nom_controller);

        if ($nom_controller == "Home") {
            $view = "Views/".$nom_view.".php";
        }else{
            $view = "Views/".$nom_controller."/".$nom_view.".php";
        }

        require_once($view);
    }
}

?>