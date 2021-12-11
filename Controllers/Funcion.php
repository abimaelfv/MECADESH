<?php

class Funcion extends Controllers{
    public function __construct(){
        parent:: __construct();

        session_start();
        if (empty($_SESSION['session'])) {
            header('location: '.base_url().'/login');
        }

    }

    public function getSelectProvincias(){
        $thmlOptions = "";
        $arrData = $this->model->selectProvincias();
        if (count($arrData) > 0) {
            for ($i=0; $i < count($arrData); $i++) { 
                $thmlOptions .= '<option value="'.$arrData[$i]['provincia'].'">'.$arrData[$i]['provincia'].'</option>';
            }
        }

        echo $thmlOptions;
        die();
    }

    public function getSelectRoles(){
        $thmlOptions = "";
        $arrData = $this->model->selectRoles();
        if (count($arrData) > 0) {
            for ($i=0; $i < count($arrData); $i++) {

                if ($arrData[$i]['status'] == 1) {
                    if (strtoupper($arrData[$i]['nombrerol']) == 'CLIENTE') {
                        $thmlOptions .= '<option selected value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
                    }else{
                        $thmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
                    } 
                }
            }
        }
        echo $thmlOptions;
        die();
    }

    public function getProvinciasPerfil(){
        $thmlOptions = "";
        $arrData = $this->model->selectProvincias();
        if (count($arrData) > 0) {
            for ($i=0; $i < count($arrData); $i++) {
                if ($_SESSION['userData']['provincia'] == $arrData[$i]['provincia']) {
                    $thmlOptions .= '<option value="'.$arrData[$i]['provincia'].'" selected hidden>'.$arrData[$i]['provincia'].'</option>';
                } 
                $thmlOptions .= '<option value="'.$arrData[$i]['provincia'].'">'.$arrData[$i]['provincia'].'</option>';
            }
        }
        
        echo $thmlOptions;
        die();
    }

}

?>