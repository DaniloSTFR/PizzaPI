<?php
include('model/clientes/clientes.class.php');

$sucesso = false;
$nameErr = $name = $telefone = $logradouro = $numero = $bairro = $complemento = $cep = "";
$formPost =  ($_SERVER["REQUEST_METHOD"] == "POST");
$novoCliente = new Clientes();
$clienteDTO = new ClienteDTO();
$readonly = " ";
$hiddenDisableCadastrar = " disabled hidden ";
$hiddenDisableEditar = " ";
$dadosClienteCarregados =  0;
$submitForm = "?controladores=clientes&acao=editar";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  //echo ('<script> console.log ("Inserir Pedido: ' . $codUsuarioLog . '|' . $loginUsuario . '|' . $nomeUsuario . '") </script>');
  $controlador = "";
  $acao = "";
  $cliente = 0;

  if (!empty($_GET['controladores'])) {
    $controlador = $_GET['controladores'];
  }

  if (!empty($_GET['acao'])) {
    $acao = $_GET['acao'];
  }

  if (!empty($_GET['cliente']) && $controlador == "clientes" && $acao == "editar") {
    $cliente = $_GET['cliente'];

    $clienteDTO = $novoCliente->bucarClientesDTO($cliente);

    $name = $clienteDTO->getNome();
    $telefone =  $clienteDTO->getTelefone();
    $logradouro =  $clienteDTO->getEndereco()->getLogradouro();
    $numero =  $clienteDTO->getEndereco()->getNumero();
    $bairro =  $clienteDTO->getEndereco()->getBairro();
    $complemento = $clienteDTO->getEndereco()->getComplemento();
    $cep = $clienteDTO->getEndereco()->getCep();

    $dadosClienteCarregados = 1;

    /*     echo ('<script> console.log ("Saida: '.'")')$cliente =  $novoCliente->inserirCliente($name, $telefone, $logradouro, $numero, $bairro, $complemento, $cep);

    if ($cliente !== FALSE){ 
      $sucesso = true;
    } */
  }
}

?>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pedidos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
  </ol>
</nav>
<div class="container container-lg themed-container">
  <h3 id="qualOPedido">Editar cadastro do cliente:</h3>
  <br>
</div>

<?php include('view/cadastroCliente.form.php'); ?>

<div id="insertPedidoSucess" class="form-row col-md-8  mx-auto">
      <!-- Falha ou sucesso na inserção -->
</div>

<script src="js/jquery-2.2.4.min.js"></script>

<script type="text/javascript">
  var totalFinal = 0;
  var listadeClientesFiltrados;

  if (Number(<?php echo $dadosClienteCarregados ; ?>)) {

    let codCliente = 0<?php echo  $clienteDTO->getCodCliente(); ?>;
    let codUsuarioRegistro = <?php echo $codUsuarioLog; ?>;
    let valorPedido = 0;
    dadosDoPedido = new dadosClientePedido(codCliente, codUsuarioRegistro, valorPedido);
    //console.log(dadosDoPedido);
  }

  function dadosClientePedido(codCliente, codUsuarioRegistro, valorPedido) {
    this.codCliente = codCliente;
    this.codUsuarioRegistro = codUsuarioRegistro;
    this.valorPedido = valorPedido;
  }

  function redirectTimeFunction() {
    console.log ("Contando");
    setTimeout(function() {
      window.location.href = "?controladores=clientes&acao=listar";
      }, 2000);
  }

  $(document).ready(function() {
    $("#btnEditar").click(function() {

        var frm_mail = document.getElementById("formCadastro");
        var frm_mail_data = new FormData(frm_mail);
        frm_mail_data.append('codCliente', '<?php echo $clienteDTO->getCodCliente(); ?>');
        frm_mail_data.append('codEndereco', '<?php echo $clienteDTO->getEndereco()->getCodEndereco(); ?>');
        frm_mail_data.append('acao', 'editarcadastro');
        
/*         console.log(frm_mail_data);
        for (var key of frm_mail_data.keys()) {
                 console.log(key+":"+frm_mail_data.get(key)); 
        } */

         
        $.ajax({
          url: "controladores/clientes/update.clientes.php",
          data: frm_mail_data,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function(result) {
            //console.log ("result:" + result);
            var saida = document.getElementById('insertPedidoSucess'); 
            if(result){
              saida.innerHTML = '<div  class="col-md-8 mx-auto  text-center alert alert-success" role="alert">Alteração salva com sucesso!</div>'; 
              redirectTimeFunction();            
            }else{
              saida.innerHTML = '<div  class="col-md-8 mx-auto  text-center alert alert-success" role="alert">Não foi possível salvar a alteração!</div>';
            }
          }
        })
        .done(function(result){
          console.log (result);
        });
 

    });

  });
</script>