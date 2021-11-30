<?php
class Controllers{

    public function __construct(){
        $this->views = new Views(); //istancia de views

        $this->loadModel();  
    }

    // Cargar modelos
    public function loadModel(){

        
        $model =get_class($this)."Model"; //HomeModel
        $ModelsClass = "Models/".$model.".php";
        if (file_exists($ModelsClass)) {
            require_once($ModelsClass);
            $this->model = new $model;

        }
    }
}


?>