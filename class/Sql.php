<?php 
class Sql extends PDO{
	
	private $con;
	private $usuario = "root";
	private $senha = "";

	public function __construct(){
		$this->con = new PDO("mysql:dbname=dbphp7;host=localhost", $this->usuario, $this->senha);
		// CONEXÃO USANDO O BANCO SQL Server
		// $usuarioServer = "SA";
		// $senhaServer = "SENHA";
		// //ConnectionPooling :> POSSIBILITA A UTILIZAÇÃO DO USO DE MULTI THREADS 
		// $con = new PDO("sqlsrv:Server=DELL;Database=dbphp7;ConnectionPooling=1", $usuarioServer, $senhaServer);
	}

	private function setParam($statment, $key, $value){
		$statment->bindParam($key, $value);
	}

	private function setParams($statment, $parameters = array()){
		foreach ($parameters as $key => $value) {
			$this->setParam($key, $value);
		}
	}

	public function query($rawQuery, $params = array()){
		$stmt = $this->con->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	public function select($rawQuery, $params = array()) : array{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>