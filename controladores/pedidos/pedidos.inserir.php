<?php 
include('model/clientes/clientes.class.php');
include('model/produtos/produtos.class.php');

$sucesso = false;
$nameErr = $name = $telefone = $logradouro = $numero = $bairro = $complemento = $cep = "";
$formPost =  ($_SERVER["REQUEST_METHOD"] == "POST");
$novoCliente = new Clientes();
$clienteDTO = new ClienteDTO();
$readonly ="readonly";
$hiddenDisable = " disabled hidden ";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  echo ('<script> console.log ("Inserir Pedido: '. $name.'|'.$logradouro.'") </script>');
  $controlador = "";
  $acao = "";
  $cliente = 0;

  if(!empty($_GET['controladores'])){
    $controlador = $_GET['controladores'];
  }
  
  if(!empty($_GET['acao'])){
    $acao = $_GET['acao'];
  }

  if(!empty($_GET['cliente'])){
    $cliente = $_GET['cliente'];

    $clienteDTO = $novoCliente->bucarClientesDTO($cliente);

    $name = $clienteDTO->getNome();
    $telefone =  $clienteDTO->getTelefone();
    $logradouro =  $clienteDTO->getEndereco()->getLogradouro();
    $numero =  $clienteDTO->getEndereco()->getNumero();
    $bairro =  $clienteDTO->getEndereco()->getBairro();
    $complemento = $clienteDTO->getEndereco()->getComplemento();
    $cep = $clienteDTO->getEndereco()->getCep();

    $produtos = new Produtos();
    $listarDeProdutos = $produtos -> listarProdutos(false);

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
    <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
  </ol>
</nav>
<div class="container container-lg themed-container" >
  <h3  id="qualOPedido">Qual seu pedido hoje ?</h3>
  <br>
</div>

<?php  include('view/cadastroCliente.form.php'); ?>


<div class="row mb-3">

  <div class="col-md-3 themed-grid-col"></div>

  <div class="col-md-6 themed-grid-col">

    <div class="form-row">
      <div class="form-group float-md-left col-md-12">
        <hr>
          <p class="h4 float-md-left">Selecionar Itens</p>
          <br>
        <hr> 
      </div>   
    </div>

    <form action="?controladores=pedidos&acao=listar" method="post">

        <div class="form-group">
          <label for="listaProdutos">Produtos</label>
          <select multiple class="form-control" name="listaProdutos" id="listaProdutos" onChange='selectItem()'>
            <?php                     
              $i = 1;
              foreach ($listarDeProdutos as &$value){
                  echo "<option value='".$value->getCodProdutos()."'  ";
                  echo " data-toggle='tooltip' data-placement='right' title='".$value->getDescricaoProduto()."' > ";
                  echo $value->getDescricaoTipo()." - ".$value->getNomeProduto()." --- R$".$value->getValor();
                  echo "</option>";
                $i++; 
              }       
            ?>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="itemescolhido">Item</label>
            <input name="itemescolhido" type="text" class="form-control" id="itemescolhido" value="" <?php echo $readonly; ?>>
          </div>
          <div class="form-group col-md-2">
            <label for="itemqX">Quantidade</label>
            <p id="itemqX" class= "float-md-right">X</p>
            <!-- <input name="itemqtd" type="text" class="form-control" id="itemqtd" value=""> -->
          </div>
          <div class="form-group col-md-2">
             <label for="itemqtd">: </label> 
            <input name="itemqtd" type="text" class="form-control" id="itemqtd" value="">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="descricaoItem">Descricao</label>
            <input name="descricaoItem" type="text" class="form-control" id="descricaoItem" value="" <?php echo $readonly; ?>>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="observacaoItem">Observação</label>
            <input name="observacaoItem" type="text" class="form-control" id="observacaoItem" value="">
          </div>
        </div>

        <div class="form-group float-md-right">
          <button type="button" class="btn btn-outline-success" onclick="adicionarItemProduto()"><strong>+ Acrescentar</strong></button>
        </div>
        
        <br> <br>
        <div class="form-group">
          <div class="form-group float-md-left col-md-12">
            <hr>
              <p class="h4 float-md-left">Pedidos do dia</p>
              <br>
            <hr> 
          </div>   
        </div>

        <div class="form-row">
          <div class="form-group col-md-12">
            <table id="itemPedidosTable" class="table table-striped" name ="itemPedidosTable" >
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>
                    <strong>1x Pizza</strong>
                    <br>- Portugesa</td>
                    <td class="float-md-right text-right" >R$ 19,00<br>
                    <strong> Editar </strong>
                    <a onclick="removerItemProduto(0)" href="#itemPedidosTable"><strong>Remover</strong></a>
                  </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td><strong>1x Pizza</strong><br>- Portugesa</td>
                  <td class="float-md-right" style="text-align:right;">R$ 19,00<br><strong>Editar </strong><strong> Remover</strong></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td><strong>1x Pizza</strong><br>- Portugesa</td>
                  <td class="float-md-right" style="text-align:right;">R$ 19,00<br><strong>Editar </strong><strong> Remover</strong></td>
                </tr>
              </tbody>

            </table>  
          </div>
        </div>

        <div class="form-group float-md-right">
          <button type="submit" class="btn btn-success btn-lg"><strong>Finalizar Pedido</strong></button>
        </div>

      </form>

  </div>

  <div class="col-md-3 themed-grid-col"></div>

</div>


<script type="text/javascript">
			function selectItem() {
				var select = document.getElementById('listaProdutos');
				var option = select.options[select.selectedIndex];

				document.getElementById('itemescolhido').value = option.text;
        document.getElementById('descricaoItem').value = option.title;
        document.getElementById('itemqtd').value = 1;
      }
      
      function removerItemProduto(){
        alert('Remover');
      }

      function adicionarItemProduto() {
        var table = document.getElementById("itemPedidosTable");
        console.log(table);
        var row = table.insertRow(0);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        cell0.innerHTML = "<strong>1</strong>";
        cell1.innerHTML = "<strong>1x Pizza</></strong><br>- Portuguesa";
        cell2.innerHTML = "R$ 19,00<br><strong> Editar </strong>"+
                          "<a onclick='removerItemProduto(0)' href='#itemPedidosTable'><strong>Remover</strong></a>";

        //cell2.style.alignItems = "float-md-right text-right";
        cell2.setAttribute("class", "float-md-right text-right");                  
      }

      function removerItemProduto(row) {
        document.getElementById("itemPedidosTable").deleteRow(row);
      }

			//selectItem();
		</script>