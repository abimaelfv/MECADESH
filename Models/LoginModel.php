<?php

class LoginModel extends Mysql{

    private $intidUsuario;
    private $strUsuario;
    private $strClave;
    private $strToken;

    public function __construct(){
        // echo "Mensaje desde el modelo home";
        parent:: __construct();
    }

    public function loginUser(string $usuario, string $clave){

        $this->strUsuario = $usuario;
        $this->strClave = $clave;

        $sql = "SELECT idpersona, status FROM personas WHERE
                (email = '$this->strUsuario' and clave = '$this->strClave' and status != 0) or
                (identificacion = '$this->strUsuario' and clave = '$this->strClave' and status != 0)";
        $request = $this->selectID($sql);

        return $request;
    }

    public function sessionData(int $idUser){
        $this->intidUsuario = $idUser;

        $sql = "SELECT p.idpersona,
                p.identificacion,
                p.nombres,
                p.apellidos,
                p.telefono,
                p.email,
                p.provincia,
                p.genero,
                p.nit,
                p.nombrefiscal,
                p.direccionfiscal,
                r.nombrerol,
                r.idrol,
                p.status 
                FROM personas as p JOIN roles as r on p.rolid = r.idrol WHERE idpersona = $this->intidUsuario";
        
        $request = $this->selectID($sql);
        
        $_SESSION['userData'] = $request; // cambios de perfil evitar deslogeo
        return $request;
    }


    public function existUserEmail(string $email){
        $this->strUsuario = $email;

        $sql = "SELECT idpersona, nombres, apellidos, status FROM personas WHERE email = '$this->strUsuario' AND status = 1";
        $request = $this->selectID($sql);

        return $request;
    }


    public function setTokenUser(string $idpersona, string $token){
        $this->intidUsuario = $idpersona;
        $this->strToken = $token;

        $sql = "UPDATE personas SET token = ? WHERE idpersona = $this->intidUsuario";
        $arrData = array($this->strToken);

        $request = $this->update($sql,$arrData);
        return $request;
    }

    public function existUsuario(string $email, string $token){
        $this->strUsuario = $email;
        $this->strToken = $token;
        $sql = "SELECT idpersona FROM personas WHERE email = '$this->strUsuario' and
                token = '$this->strToken' and status = 1";

        $request = $this->selectID($sql);

        return $request;
    }


    public function UpdatePassword(int $idpersona, string $password){
        $this->intidUsuario = $idpersona;
        $this->strClave = $password;

        $sql = "UPDATE personas SET clave = ?, token = ? WHERE idpersona = $this->intidUsuario";
        $arrData = array($this->strClave,"");
        $request = $this->update($sql,$arrData);

        return $request;
    }

}

?>