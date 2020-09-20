<?php
session_start();
include('conexao.php');

if(empty($_POST['login']) || empty($_POST['senha'])) {
	header('Location: telaLogin.php');
	exit();
}

$login = mysqli_real_escape_string($conexao, $_POST['login']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select nome from usuario where login = '{$login}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
	$usuario_bd = mysqli_fetch_assoc($result);
	$_SESSION['nome'] = $usuario_bd['nome'];
	header('Location: index.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: telaLogin.php');
	exit();
}
?>