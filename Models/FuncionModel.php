<?php 

	class FuncionModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        //EXTRAE SELECT ROLES
        public function selectRoles(){

            $whereAdmin = "";
            if($_SESSION['idUser'] != 1){
                $whereAdmin = " and idrol != 1";
            }

            $sql = "SELECT * FROM roles WHERE status != 0".$whereAdmin;
            $request = $this->select($sql);
            return $request;
        }

        //EXTRAE SELECT PROVINCIAS
        public function selectProvincias(){
            
            $sql = "SELECT * FROM provincias";
            $request = $this->select($sql);
            return $request;
        }
		
	}
 ?>