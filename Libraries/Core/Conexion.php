<?php 

class Conexion{

    private $host = 'localhost';
    private $database = 'mecadesh2';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8';

    private $opciones = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES\'UTF8\'',\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION);
    
    public $conectar;

    public function __construct(){
        $dsn = "mysql:host=".$this->host.";dbname=".$this->database.";charset=".$this->charset;

        try {
            $this->conectar = new PDO($dsn, $this->username, $this->password, $this->opciones);
        } catch (PDOExeption $e) {
            $this->conectar = 'Error de conexión';
            echo "ERROR: ".$e->getMessage();
        }

    }

    public function desconectar(){
        $this->conectar = null;
    }
}

?>