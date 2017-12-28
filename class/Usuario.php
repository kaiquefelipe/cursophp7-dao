<?php  

class Usuario {
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($valor){
		$this->idusuario = $valor;
	}

	public function getDesLogin(){
		return $this->deslogin;
	}

	public function setDesLogin($valor){
		$this->deslogin = $valor;
	}

	public function getDesSenha(){
		return $this->dessenha;
	}

	public function setDesSenha($valor){
		$this->dessenha = $valor;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($valor){
		$this->dtcadastro = $valor;
	}

	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		if(count($results) > 0){
			$row = $results[0];
			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

	public function __toString(){
		return json_encode(array(
			"Id Usuario"=>$this->getIdUsuario(),
			"Login"=>$this->getDesLogin(),
			"Senha"=>$this->getDesSenha(),
			"Data de cadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}

?>