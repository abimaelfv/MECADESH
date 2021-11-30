<?php

class Mysql extends Conexion{

    private $conexion;
    private $strquery;
    private $arrvalues;

    function __construct(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar;
    }

    // Insertar registro
    public function insert(string $query, array $arrvalues){
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $insert = $this->conexion->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrvalues);

        if ($resInsert) {
            $lastInsert = $this->conexion->lastInsertId();
        }else{
            $lastInsert = 0;
        }

        return $lastInsert;
    }

    // Buscar registro por id
    public function selectID(string $query){
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // todo los registros
    public function select(string $query){
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    // actualizar registro
    public function update(string $query, array $arrvalues){
        $this->strquery = $query;
        $this->arrvalues = $arrvalues;
        $update = $this->conexion->prepare($this->strquery);
        $resUpdate = $update->execute($this->arrvalues);
        return $resUpdate;
    }

    //Eliminar un registro
    public function delete(string $query){
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $resDelete = $result->execute();
        return $resDelete;
    }

}

?>