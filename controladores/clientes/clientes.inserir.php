<?php
include('model/clientes/clientes.class.php');

$sucesso = false;
$nameErr = $name = "";
$formPost =  ($_SERVER["REQUEST_METHOD"] == "POST");
$novoCliente = new Clientes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["nomeCliente"];
  $telefone =  $_POST["telefone"];
  $logradouro =  $_POST["endereco"];
  $numero =  $_POST["numero"];
  $bairro =  $_POST["bairro"];
  $complemento =$_POST["complemento"];
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


<div class="row mb-3">

  <div class="col-md-3 themed-grid-col"></div>

  <div class="col-md-6 themed-grid-col">

<?php  if($sucesso && $formPost){  ?>
      <div class="form-row">
          <div class="col-md-12  alert alert-success" role="alert">
            Cliente <?php  echo ($name.$nameErr); ?>, cadastrado  com sucesso !
          </div>
      </div>       
<?php  } else if($formPost){ ?>
      <div class="form-row">
          <div class="col-md-12  alert alert-danger" role="alert">
            Erro no cadastrado:  <?php  echo ($name.$nameErr); ?> !
          </div>
      </div> 
<?php  }  ?>

      <div class="form-row">
        <div class="form-group col-md-6">
        <p class="h4">Dados do Cliente</p>
        </div>
        <div class="form-group col-md-6">
          <button type="button" class="btn btn-primary float-md-right" data-toggle="modal" data-target="#exampleModal">
              Buscar Cliente
          </button>
        </div>
      </div>

      <hr>
      
      <!--  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' >-->
      <form action="?controladores=clientes&acao=inserir" method='post' >

        <div class="form-group">
          <label for="nomeCliente">Nome Completo</label>
          <input name="nomeCliente" type="text" class="form-control" id="nomeCliente" >
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cep">CEP</label>
            <input name="cep" type="text" class="form-control" id="cep" placeholder="66666-000" pattern="[0-9]{5}-[0-9]{3}">
          </div>
          <div class="form-group col-md-6">
            <label for="telefone">WhatsApp</label>
            <input name="telefone" type="text" class="form-control" id="telefone" placeholder="91-99999-9999" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-10">
            <label for="endereco">Endereço</label>
            <input name="endereco" type="text" class="form-control" id="endereco" >
          </div>
          <div class="form-group col-md-2">
            <label for="numero">Número</label>
            <input name="numero" type="text" class="form-control" id="numero">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="bairro">Bairro</label>
            <input name="bairro" type="text" class="form-control" id="bairro">
          </div>
          <div class="form-group col-md-8">
            <label for="complemento">Complemento</label>
            <input name="complemento" type="text" class="form-control" id="complemento" >
          </div>
        </div>
        <div class="form-group float-md-right">
          <button type="submit" class="btn btn-success ">Salvar dados</button>
        </div>
      </form>
  </div>

  <div class="col-md-3 themed-grid-col"></div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar cliente cadastrado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Carregar dados</button>
      </div>
    </div>
  </div>
</div>