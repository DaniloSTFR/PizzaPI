<?php
session_start();
include('../../model/login/login.class.php');

if(empty($_POST['login']) || empty($_POST['senha'])) {
	header('Location: ../../login.php');
	exit();
}

$lg = new Login();
$row = $lg->validacaoDeLogin($_POST['login'],$_POST['senha']);


if($row == 1) {
 	$usuario_bd = $lg->getFetchAssoc();
	$_SESSION['nome'] = $usuario_bd['nome'];
	header('Location: ../../index.php');
	exit(); 
} else {
 	$_SESSION['nao_autenticado'] = true;
	header('Location: ../../login.php');
	exit(); 
} 
?>