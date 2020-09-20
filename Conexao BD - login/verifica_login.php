<?php
if(!$_SESSION['nome']) {
	header('Location: telaLogin.php');
	exit();
}

?>