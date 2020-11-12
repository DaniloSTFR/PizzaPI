<?php
include('model/clientes/clientes.class.php');
include('model/produtos/produtos.class.php');


$sucesso = false;
$nameErr = $name = $telefone = $logradouro = $numero = $bairro = $complemento = $cep = "";
$formPost =  ($_SERVER["REQUEST_METHOD"] == "POST");
$novoCliente = new Clientes();
$clienteDTO = new ClienteDTO();
$readonly = "readonly";
$hiddenDisableCadastrar = " disabled hidden ";
$hiddenDisableEditar = " disabled hidden ";
$dadosClienteCarregados =  0;
$submitForm = "";

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

  if (!empty($_GET['cliente']) && $controlador == "pedidos" && $acao == "inserir") {
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

    $produtos = new Produtos();
    $listarDeProdutos = $produtos->listarProdutos(true);

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
<div class="container container-lg themed-container">
  <h3 id="qualOPedido">Qual seu pedido hoje ?</h3>
  <br>
</div>

<?php include('view/cadastroCliente.form.php'); ?>

<?php include('view/cadastroPedido.form.php'); ?>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript">
  var totalFinal = 0;
  var dadosDoPedido;
  var dadosItenspedidos = [];
  var listadeClientesFiltrados;
  var codClientePHP = <?php echo  $clienteDTO->getCodCliente(); ?>;

  if (Number(<?php echo $dadosClienteCarregados ; ?>)) {   
    let codUsuarioRegistro = <?php echo $codUsuarioLog; ?>;
    let valorPedido = 0;
    dadosDoPedido = new dadosClientePedido(codClientePHP, codUsuarioRegistro, valorPedido);
    console.log("Novo:"+ codClientePHP);
    console.log(dadosDoPedido);
  }

  function dadosItemDoPedido(codProdutos, quatidade, valorFinal, observacaoItem) {
    this.codProdutos = codProdutos;
    this.quatidade = quatidade;
    this.valorFinal = valorFinal;
    this.observacaoItem = observacaoItem;
  }

  function dadosClientePedido(codCliente, codUsuarioRegistro, valorPedido) {
    this.codCliente = codCliente;
    this.codUsuarioRegistro = codUsuarioRegistro;
    this.valorPedido = valorPedido;
  }

  function selectItem() {
    var select = document.getElementById('listaProdutos');
    var option = select.options[select.selectedIndex];

    document.getElementById('itemescolhido').value = option.text;
    document.getElementById('descricaoItem').value = option.title;
    document.getElementById('itemqtd').value = 1;
  }

  function adicionarItemProduto() {
    var select = document.getElementById('listaProdutos');
    var option = select.options[select.selectedIndex];
    //console.log (option.value);
    var itemescolhido = document.getElementById("itemescolhido");
    var itemqtd = document.getElementById("itemqtd");
    var descricaoItem = document.getElementById("descricaoItem");
    var observacaoItem = document.getElementById("observacaoItem");
    var totalfinalP = document.getElementById("totalfinal");

    let someArray = dadosItenspedidos.filter(x => x.codProdutos == option.value);
    //console.log(someArray);

    
    if (Number.isInteger(Number(itemqtd.value)) && itemqtd.value != "" && itemescolhido.value != "" && descricaoItem.value != "") {
      if(someArray.length==1){
        alert("O item já esta inserido no pedido.");
      }
      else{
        var table = document.getElementById("itemPedidosTable");

        var str = itemescolhido.value;
        var itemArray = str.split(" -- ");
        itemArray[2] = parseFloat(itemArray[2].replace("R$", ""))
        itemArray[2] *= Number(itemqtd.value);
        totalFinal += itemArray[2];
        //console.log (totalFinal);

        var nline = table.rows.length;
        //console.log ('numero:'+nline);
        var row = table.insertRow(nline);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        //cell0.innerHTML = "<strong>"+(nline+1)+"</strong>";
        cell1.innerHTML = "<strong>" + (Number(itemqtd.value)) + "x " + itemArray[0] + "</></strong><br>" +
          "- " + itemArray[1] + " <br>" +
          "<strong>Obs: </strong>" + observacaoItem.value + "<br>";
        cell2.innerHTML = monetario(itemArray[2]) + "<br><strong> Editar </strong>" +
          "<a onclick='removerItemProduto(this," + option.value + ")' href='#itemPedidosTable'><strong>Remover</strong></a>";

        cell2.setAttribute("class", "float-md-right text-right");
        row.setAttribute("id", "codItem" + option.value);
        row.setAttribute("value", option.value);
        totalfinalP.innerHTML = "Total: " + monetario(totalFinal);
        //Objeto com o item selecionado
        let itemDados = new dadosItemDoPedido(Number(option.value), Number(itemqtd.value), itemArray[2], observacaoItem.value);
        dadosItenspedidos.push(itemDados);

        itemescolhido.value = "";
        itemqtd.value = "";
        descricaoItem.value = "";
        observacaoItem.value = "";
      }
    }

  }

  function removerItemProduto(row, codProduto) {
    let i = row.parentNode.parentNode.rowIndex;
    let someArray = dadosItenspedidos.filter(x => x.codProdutos == codProduto);
    let itemRemovido = someArray.shift();
    dadosItenspedidos.splice(dadosItenspedidos.findIndex(x => x.codProdutos == codProduto), 1);

    totalFinal -= itemRemovido.valorFinal;
    let totalfinalP = document.getElementById("totalfinal");
    totalfinalP.innerHTML = "Total: " + monetario(totalFinal);

    document.getElementById("itemPedidosTable").deleteRow(i);

    //console.log(dadosItenspedidos);
  }

  function monetario(numero) {
    var dinheiro = numero.toLocaleString('pt-br', {
      style: 'currency',
      currency: 'BRL'
    });
    return dinheiro;
  }

  function redirectTimeFunction() {
    console.log ("Contando");
    setTimeout(function() {
      window.location.href = "?controladores=pedidos&acao=listar";
      }, 2000);
  }


  $(document).ready(function() {
    $("#btfinalizarPedido").click(function() {
      if (dadosItenspedidos.length > 0) {
        dadosDoPedido.valorPedido = totalFinal;
        dadosDoPedido.itensPedidos = dadosItenspedidos;

        var frm_mail_data = new FormData();
        //frm_mail_data.append('totalFinal', totalFinal);
        frm_mail_data.append('dadospedidojson', JSON.stringify(dadosDoPedido));
       

        var obj = JSON.parse(frm_mail_data.get('dadospedidojson'));
        console.log (obj)

         $.ajax({
          url: "controladores/pedidos/finalizarpedido.inserir.php",
          data: frm_mail_data,
          cache: false,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function(result) {
            //console.log ("result:" + result);
            var saida = document.getElementById('insertPedidoSucess'); 
            if(result){
              saida.innerHTML = '<div  class="col-md-12  alert alert-success" role="alert">Pedido salvo com sucesso!'+result+'</div>'; 
              //console.log (result);
              redirectTimeFunction();            
            }else{
              saida.innerHTML = '<div  class="col-md-12  alert alert-danger" role="alert">Não foi possível salvar o pedido!</div>';
            }
          }
        }); 

      } else {
        alert('Nenhum item foi selecionado !');
      }

    });

  });
</script>