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
			$this->setData($results[0]);
		}
	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :LOGIN ORDER BY deslogin;", array(
				':LOGIN' => "%" . $login . "%")
		);
	}

	public function login($login, $pw){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PW", array(
			":LOGIN"=>$login,
			":PW"=>$pw
		));

		if(count($results) > 0){
			$this->setData($results[0]);
		}

		else{
			throw new Exception("LOGIN E/OU SENHA INVÁLIDOS");
		}

	}

	public function setData($data){
		$this->setIdUsuario($data['idusuario']);
		$this->setDesLogin($data['deslogin']);
		$this->setDesSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));
	}

	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PW)",array(
			":LOGIN" => $this->getDesLogin(),
			":PW" => $this->getDesSenha()
		));
		if(count($results) > 0){
			$this->setData($results[0]);
		}
	}

	public function update($login){
		$this->setDesLogin($login);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN WHERE idusuario = :ID", array(
			":LOGIN" => $this->getDesLogin(),
			":ID" => $this->getIdUsuario()
		));
	}

	public function __construct($login = "", $pw = ""){
		$this->setDesLogin($login);
		$this->setDesSenha($pw);
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