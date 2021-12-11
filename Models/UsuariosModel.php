<?php

class UsuariosModel extends Mysql{

    private $intIdUsuario;
    private $strIdentificacion;
    private $intRolid;
    private $strNombre;
    private $strApellido;
    private $intTelefono;
    private $strEmail;
    private $strProvincia;
    private $strGenero;
    private $strClave;
    private $strToken;
    private $intEstado;
    private $strNit;
    private $strNombreFiscal;
    private $strDireccionFiscal;

    public function __construct(){
        parent:: __construct();
    }

    public function insertUsuario(string $strIdentificacion, int $intRolid, string $strNombre, string $strApellido, int $intTelefono, string $strEmail, string $strProvincia, string $strGenero, string $strClave){
        $this->strIdentificacion = $strIdentificacion;
        $this->intRolid = $intRolid;
        $this->strNombre = $strNombre;
        $this->strApellido = $strApellido;
        $this->intTelefono = $intTelefono;
        $this->strEmail = $strEmail;
        $this->strProvincia = $strProvincia;
        $this->strGenero = $strGenero;
        $this->strClave = $strClave;

        $return = 0;

        $sqlIdent = "SELECT * FROM personas WHERE identificacion = '{$this->strIdentificacion}'";
        $requestIdent = $this->select($sqlIdent);

        if (empty($requestIdent)) { // existencia Identificasion

            $sqlEmail = "SELECT * FROM personas WHERE  email = '{$this->strEmail}'";
            $requestEmail = $this->select($sqlEmail);

            if (empty($requestEmail)) { // existencia Email

                $sql_insert = "INSERT INTO personas(rolid,identificacion,nombres,apellidos,telefono,email,provincia,genero,clave)
                VALUES (?,?,?,?,?,?,?,?,?)";
    
                $arrData = array(
                    $this->intRolid,
                    $this->strIdentificacion,
                    $this->strNombre,
                    $this->strApellido,
                    $this->intTelefono,
                    $this->strEmail,
                    $this->strProvincia,
                    $this->strGenero,
                    $this->strClave,
                );
    
                $request_insert = $this->insert($sql_insert, $arrData);
                $return = $request_insert;
            }else{
                $return = 'existEmail';
            }

        }else{
            $return = 'existIdent';
        }

        return $return;
    }


    public function updateUsuario(int $intIdUsuario, string $strIdentificacion, int $intRolid, string $strNombre, string $strApellido, int $intTelefono, string $strEmail, string $strProvincia, string $strGenero, int $intEstado, string $strClave){
        $this->intIdUsuario = $intIdUsuario;
        $this->strIdentificacion = $strIdentificacion;
        $this->intRolid = $intRolid;
        $this->strNombre = $strNombre;
        $this->strApellido = $strApellido;
        $this->intTelefono = $intTelefono;
        $this->strEmail = $strEmail;
        $this->strProvincia = $strProvincia;
        $this->strGenero = $strGenero;
        $this->intEstado = $intEstado;
        $this->strClave = $strClave;

        $return = 0;

        $sqlIdent = "SELECT * FROM personas WHERE identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario";
        $requestIdent = $this->select($sqlIdent);

        if (empty($requestIdent)) { // existencia Identificasion

            $sqlEmail = "SELECT * FROM personas WHERE  email = '{$this->strEmail}' AND idpersona != $this->intIdUsuario";
            $requestEmail = $this->select($sqlEmail);

            if (empty($requestEmail)) { // existencia Email

                if ($this->strClave != "") {

                    $sql_update = "UPDATE personas SET rolid = ?, identificacion = ?, nombres = ?, apellidos = ?, telefono = ?, email = ?, provincia = ?, genero = ?, status = ?, clave = ? WHERE idpersona = $this->intIdUsuario";
        
                    $arrData = array(
                        $this->intRolid,
                        $this->strIdentificacion,
                        $this->strNombre,
                        $this->strApellido,
                        $this->intTelefono,
                        $this->strEmail,
                        $this->strProvincia,
                        $this->strGenero,
                        $this->intEstado,
                        $this->strClave,
                    );
                }else{

                    $sql_update = "UPDATE personas SET rolid = ?, identificacion = ?, nombres = ?, apellidos = ?, telefono = ?, email = ?, provincia = ?, genero = ?, status = ? WHERE idpersona = $this->intIdUsuario";
        
                    $arrData = array(
                        $this->intRolid,
                        $this->strIdentificacion,
                        $this->strNombre,
                        $this->strApellido,
                        $this->intTelefono,
                        $this->strEmail,
                        $this->strProvincia,
                        $this->strGenero,
                        $this->intEstado
                    );
                }

                $return = $this->update($sql_update, $arrData);
                
            }else{
                $return = 'existEmail';
            }

        }else{
            $return = 'existIdent';
        }

        return $return;
    }

    public function selectUsuarios(){

        $whereAdmin = "";
        if ($_SESSION['idUser'] != 1) {
            $whereAdmin = " and p.idpersona != 1";
        }

        $sql = "SELECT idpersona,identificacion,nombres,apellidos,telefono,provincia,r.nombrerol, r.idrol,p.status 
        FROM personas as p JOIN roles as r on p.rolid = r.idrol WHERE p.status != 0".$whereAdmin;
        
        $request = $this->select($sql);
        return $request;

    }

    public function selectUsuario(int $idpersona){

        $this->intIdUsuario = $idpersona;
        $sql = "SELECT idpersona,idrol,identificacion,nombres,apellidos,telefono,email,provincia,genero,r.nombrerol,DATE_FORMAT(created, '%d-%m-%Y %h:%m %p') as fechaRegistro,p.status 
        FROM personas as p JOIN roles as r on p.rolid = r.idrol WHERE p.status != 0 and idpersona = '{$this->intIdUsuario}'";
        
        $request = $this->selectID($sql);
        return $request;
        
    }


    public function deleteUsuario(int $id)
    {
        $this->intId = $id;
        $sql = "UPDATE personas SET status = ? WHERE idpersona = $this->intId ";
        $arrData = array(0);
        $request = $this->update($sql,$arrData);

        return $request;
    }



    // SECCION PERFIL ========================================

    public function updatePerfil(int $intIdUsuario, string $strIdentificacion, string $strNombre, string $strApellido, string $strProvincia, string $strGenero){
        $this->intIdUsuario = $intIdUsuario;
        $this->strIdentificacion = $strIdentificacion;
        $this->strNombre = $strNombre;
        $this->strApellido = $strApellido;
        $this->strProvincia = $strProvincia;
        $this->strGenero = $strGenero;

        $return = 0;

        $sqlIdent = "SELECT * FROM personas WHERE identificacion = '{$this->strIdentificacion}' AND idpersona != $this->intIdUsuario";
        $requestIdent = $this->select($sqlIdent);

        if (empty($requestIdent)) { // existencia Identificasion

            $sql_update = "UPDATE personas SET identificacion = ?, nombres = ?, apellidos = ?, provincia = ?, genero = ? WHERE idpersona = $this->intIdUsuario";

            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->strProvincia,
                $this->strGenero,
            );

            $return = $this->update($sql_update, $arrData);
        }else{
            $return = 'existIdent';
        }
        return $return;
    }

    public function updateContacto(int $intIdUsuario, int $intTelefono, string $strEmail){
        $this->intIdUsuario = $intIdUsuario;
        $this->intTelefono = $intTelefono;
        $this->strEmail = $strEmail;

        $return = 0;

        $sqlEmail = "SELECT * FROM personas WHERE  email = '{$this->strEmail}' AND idpersona != $this->intIdUsuario";
        $requestEmail = $this->select($sqlEmail);

        if (empty($requestEmail)) { // existencia Email

                $sql_update = "UPDATE personas SET telefono = ?, email = ? WHERE idpersona = $this->intIdUsuario";
    
                $arrData = array(
                    $this->intTelefono,
                    $this->strEmail,
                );

            $return = $this->update($sql_update, $arrData);
                
        }else{
            $return = 'existEmail';
        }
        return $return;
    }

    public function confirmarClave(string $idpersona, string $password){
        $this->intidUsuario = $idpersona;
        $this->strClave = $password;
        $sql = "SELECT idpersona FROM personas WHERE clave = '$this->strClave' and
                idpersona = '$this->intidUsuario' and status = 1";

        $request = $this->selectID($sql);

        return $request;
    }

    public function UpdatePassword(int $idpersona, string $password){
        $this->intidUsuario = $idpersona;
        $this->strClave = $password;

        $sql = "UPDATE personas SET clave = ? WHERE idpersona = $this->intidUsuario";
        $arrData = array($this->strClave);
        $request = $this->update($sql,$arrData);

        return $request;

    }


    public function updateDataFiscal(int $IdUsuario, string $Nit, string $NombreFiscal, string $DireccionFiscal){
        $this->intIdUsuario = $IdUsuario;
        $this->strNit = $Nit;
        $this->strNombreFiscal = $NombreFiscal;
        $this->strDireccionFiscal = $DireccionFiscal;

        $return = 0;

            $sql_update = "UPDATE personas SET nit = ?, nombrefiscal = ?, direccionfiscal = ? WHERE idpersona = $this->intIdUsuario";

            $arrData = array(
                $this->strNit,
                $this->strNombreFiscal,
                $this->strDireccionFiscal
            );

            $request = $this->update($sql_update, $arrData);
            
        return $request;
    }

}

?>