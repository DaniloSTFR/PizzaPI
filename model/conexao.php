<?php
// esse arquivo não é mais necessario para a apalicação
// a funcionalidade foi susbstituido por conexao.class.php

define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'pizzapi');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>