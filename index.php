<?php  

require_once("config.php");

// Carrega somente um usuário
// $usuario = new Usuario();
// $usuario->loadById(2);
// echo $usuario;

// Carrega uma LISTA de Usuários
// $lUsuarios = Usuario::getList();
// echo json_encode($lUsuarios);

// Carrega uma LISTA de Usuários buscando pelo Login
// $search = Usuario::search("u");
// echo json_encode($search);

// Carrega um usuário autenticado, usando o login e senha
// $usuario = new Usuario();
// $usuario->login("kaique", "123456");
// echo $usuario;

// Criando um novo Usuário
// $aluno = new Usuario("Ruth", "123456");
// $aluno->insert();
// echo $aluno;

// Alterando um usuário
// $usuario = new Usuario();
// $usuario->loadById(6);
// $usuario->update("New Ruth");
// echo $usuario;

// Deletando um usuário
$usuario = new Usuario();
$usuario->loadById(5);
$usuario->delete();
echo $usuario;

?>