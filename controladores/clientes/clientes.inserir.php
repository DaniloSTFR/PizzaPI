<?php
include('model/clientes/clientes.class.php');

$sucesso = false;
$nameErr = $name = $telefone = $logradouro = $numero = $bairro = $complemento = $cep = "";
$readonly ="";
$hiddenDisableCadastrar = " ";
$hiddenDisableEditar = " disabled hidden ";
$submitForm = "?controladores=clientes&acao=inserir";


$formPost =  ($_SERVER["REQUEST_METHOD"] == "POST");
$novoCliente = new Clientes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strtoupper($_POST["nomeCliente"]);
  $telefone =  $_POST["telefone"];
  $logradouro =  strtoupper($_POST["endereco"]);
  $numero =  $_POST["numero"];
  $bairro =  strtoupper($_POST["bairro"]);
  $complemento = strtoupper($_POST["complemento"]);
  $cep =$_POST["cep"];

  $cliente =  $novoCliente->inserirCliente($name, $telefone, $logradouro, $numero, $bairro, $complemento, $cep);

  if ($cliente !== FALSE){ 
    $sucesso = true;
  }
}
?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
  </ol>
</nav>

<?php  include('view/cadastroCliente.form.php'); ?>

