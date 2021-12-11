<?php

class RolesModel extends Mysql{

    public $intIdrol;
    public $strRol;
    public $strDescripcion;
    public $intStatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectRoles()
    {   

        //EXTRAE ROLES
        $sql = "SELECT * FROM roles WHERE status != 0";
        $request = $this->select($sql);
        return $request;
    }

    public function selectRol(int $idrol)
    {
        //BUSCAR ROLE
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM roles WHERE idrol = $this->intIdrol";
        $request = $this->selectID($sql);
        return $request;
    }

    public function insertRol(string $rol, string $descripcion, int $status){

        $return = "";
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM roles WHERE nombrerol = '{$this->strRol}' ";
        $request = $this->select($sql);

        if(empty($request))
        {
            $query_insert  = "INSERT INTO roles(nombrerol,descripcion,status) VALUES(?,?,?)";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        }else{
            $return = "exist";
        }
        return $return;
    }	

    public function updateRol(int $idrol, string $rol, string $descripcion, int $status){
        $this->intIdrol = $idrol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM roles WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
        $request = $this->selectID($sql);

        if(empty($request))
        {
            $sql = "UPDATE roles SET nombrerol = ?, descripcion = ?, status = ? WHERE idrol = $this->intIdrol ";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }

    public function deleteRol(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM personas WHERE rolid = $this->intIdrol";
        $request = $this->selectID($sql);
        if(empty($request))
        {
            $sql = "UPDATE roles SET status = ? WHERE idrol = $this->intIdrol ";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            if($request)
            {
                $request = 'ok';	
            }else{
                $request = 'error';
            }
        }else{
            $request = 'exist';
        }
        return $request;
    }

}

?>