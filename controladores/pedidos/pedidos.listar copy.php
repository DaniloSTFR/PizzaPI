<?php
include_once('model/pedidos/pedidos.class.php');

$discriminador = "";

if (!empty($_GET['discriminador'])) {
  $discriminador = $_GET['discriminador'];
  echo "discriminador".$discriminador;
}

$pedidos = new Pedidos();

$sucessoPedidosAtivos = $pedidos->listarTodosPedidosAtivos();
$listaPedidosAtivos = array();
$listaPedidosAtivosPorFiltro = array();

if ($sucessoPedidosAtivos) {
  $listaPedidosAtivos = $sucessoPedidosAtivos;
  //print_r ($listaPedidosAtivos);
  if(strlen($discriminador)>0){
    $listaPedidosAtivosPorFiltro = arrayItemFilterPorNome('nome', $discriminador, $listaPedidosAtivos);
  }else{
    $listaPedidosAtivosPorFiltro = $listaPedidosAtivos;
  }
}

$sucessoItensPedidosAtivos = $pedidos->listarItensTodosPedidosAtivos();
$listaItensPedidosAtivos = array();
if ($sucessoItensPedidosAtivos) {
  $listaItensPedidosAtivos = $sucessoItensPedidosAtivos;
  //print_r ($listaItensPedidosAtivos);
} else {
  $msg = "Não há pedidos...";
  array_push($listaItensPedidosAtivos, $msg);
}

function dateEmMysql($dateSql)
{
  $ano = substr($dateSql, 0, 4);
  $mes = substr($dateSql, 5, 2);
  $dia = substr($dateSql, 8, 2);

  $hora = substr($dateSql, 10);
  return $dia . "/" . $mes . "/" . $ano . " " . $hora;
  //return $ano;
}
function arrayItemFilter($idObject, $valueObject, $arrayObject)
{
  //array_filter ( array $array [, callable $callback [, int $flag = 0 ]] ) : array
  $arrayResult = (array_filter($arrayObject, function ($v, $k) use ($idObject, $valueObject) {
    return $v->$idObject == $valueObject;
  }, ARRAY_FILTER_USE_BOTH));

  return ($arrayResult);
}

function arrayItemFilterPorNome($idObject, $valueObject, $arrayObject)
{
  //array_filter ( array $array [, callable $callback [, int $flag = 0 ]] ) : array
  echo "dentro do filtro";
  $arrayResult = (array_filter($arrayObject, function ($v, $k) use ($idObject, $valueObject) {
    $mystring = strtoupper($v->$idObject);
    $findme   = strtoupper($valueObject);

    echo $mystring .'+'. $findme;
    return  (strpos($mystring, $findme) !== false);
  }, ARRAY_FILTER_USE_BOTH));

  return ($arrayResult);
}

function defineStatusClass($codStatusPedido, $statusDescricao, $codPedido)
{
  switch ($codStatusPedido) {
    case 1:
      return ('<div id="status' . $codPedido . '" class="alert btn-warning" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
      break;
    case 2:
      return ('<div id="status' . $codPedido . '" class="alert btn-danger" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
      break;
    case 3:
      return ('<div id="status' . $codPedido . '" class="alert btn-success" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
      break;
    case 4:
      return ('<div id="status' . $codPedido . '" class="alert btn-info" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
      break;
    case 5:
      return ('<div id="status' . $codPedido . '" class="alert btn-secondary" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
      break;
    default:
      return ('<div id="status' . $codPedido . '" class="alert btn-dark" role="alert"><strong>Status do Pedido: ' . $statusDescricao . '</strong></div>');
  }
}
function defineButtonStatusClass($codStatusPedido, $statusDescricao, $codPedido)
{
  switch ($codStatusPedido) {
    case 1:
      return ('<button id="statusButton' . $codPedido . '"  type="button" class="btn btn-outline-danger float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',2)"><strong>Enviar para produção</strong></button>');
      break;
    case 2:
      return ('<button id="statusButton' . $codPedido . '" type="button" class="btn btn-outline-success float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',3)"><strong>O pedido está Pronto</strong></button>');
      break;
    case 3:
      return ('<button id="statusButton' . $codPedido . '" type="button" class="btn btn-outline-info float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',4)"><strong>Enviar para entrega</strong></button>');
      break;
    case 4:
      return ('<button id="statusButton' . $codPedido . '" type="button" class="btn btn-outline-secondary float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',5)"><strong>Pedido concluído</strong></button>');
      break;
    case 5:
      return ('<button id="statusButton' . $codPedido . '" type="button" class="btn btn-outline-warning float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',1)"><strong>Reativar pedido</strong></button>');
      break;
    default:
      return ('<button id="statusButton' . $codPedido . '" type="button" class="btn btn-outline-dark" float-md-right" onclick="atualizarStatusDoPedido(' . $codPedido . ',6)"><strong>Cancelar Pedido</strong></button>');
  }
}


?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pedidos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listar</li>
  </ol>
</nav>

<div class="row mb-3">

  <div class="col-md-2 themed-grid-col"></div>

  <div class="col-md-8 themed-grid-col">

    <div class="form-row">
      <div class="form-group float-md-left col-md-12">
        <hr>
        <p class="h4 float-md-left">Pedidos do Dia</p>
        <br>
        <hr>
      </div>
    </div>

    <?php
    if (count($listaPedidosAtivosPorFiltro) > 0) {
      foreach ($listaPedidosAtivosPorFiltro as &$value) { // var_dump($listaPedidosAtivos); 
    ?>
        <div id="card<?php echo $value->codPedido; ?>"  class="card bg-light mb-3" style="max-width: 45rem;">
          <div class="card-header bg-transparent form-row ">
            <div class="form-group col-md-6">
              <h5><?php echo $value->nome;  ?></h5><br>
              <span><?php echo $value->telefone;  ?></span>
            </div>
            <div class="form-group col-md-2">
              <span>Data-hora: <?php echo (dateEmMysql($value->dataCriacao));  ?></span>
            </div>
            <div class="form-group col-md-4 float-md-right">
              <button type="button" class="btn btn-danger float-md-right" onclick="cancelarPedido()"><strong>Canlcelar<br>Pedido</strong></button>
            </div>
          </div>

          <?php
          $arrayItensPorPedido = arrayItemFilter('codPedido', $value->codPedido, $listaItensPedidosAtivos);
          ?>
          <div class="card-body form-row">
            <div class="form-group col-md-6">
              <p class="card-text">Detalhes do Pedido:<br>
                <?php foreach ($arrayItensPorPedido as &$item) { ?>
                  &nbsp;&nbsp;- <?php echo '<strong>' . $item->quatidade . '</strong>x ' . $item->descricaoTipo . '(S)'; ?>
                  &nbsp;&nbsp; <?php echo ': <strong>' . $item->nomeProduto . '</strong>'; ?><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor: R$<?php echo $item->valorFinal; ?><br>
                <?php } ?>
              </p>
            </div>
            <div class="container form-group col-md-6">
              <div class="row row-cols-1">
                <div class="col col-sm-12">
                  <button type="button" class="btn btn-info float-md-left" onclick="cancelarPedido()">Editar<br>Pedido</button>
                </div>
                <div class="col col-sm-12">
                  <br>
                </div>
                <div class="col col-sm-12">
                  <?php echo defineStatusClass($value->codStatusPedido, $value->statusDescricao, $value->codPedido); ?>
                </div>
              </div>
            </div>


          </div>
          <div class="card-footer bg-transparent form-row">
            <div class="form-group col-6 col-sm-4">
              <strong>Total: R$ <?php echo $value->valorPedido;  ?></strong>
            </div>
            <div class="form-group col-6 col-sm-4">
              <button type="button" class="btn btn-success float-md-right" onclick="cancelarPedido()"><strong>Entrar em contato</strong></button>
            </div>
            <div class="form-group col-6 col-sm-4">
              <?php echo defineButtonStatusClass($value->codStatusPedido, $value->statusDescricao, $value->codPedido); ?>
            </div>
          </div>
          <div id="insertPedidoSucess<?php echo $value->codPedido;?>"></div>
        </div>
        <br>
    <?php }
    } else {
      echo "<div class='form-group col-md-6'><h5>Não há pedidos...</h5><br></div>";
    }

    ?>


  </div>

  <div class="col-md-2 themed-grid-col"></div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript">
  var listaItensPedidosAtivosObj = <?php echo json_encode($listaItensPedidosAtivos); ?>;
  var listarPedidosAtivosObj = <?php echo json_encode($listaPedidosAtivos); ?>;

  function cancelarPedido() {
    console.log("Botão clicado");
  }

  function redirectTimeFunction() {
    console.log ("Contando");
    setTimeout(function() {
      window.location.href = "?controladores=pedidos&acao=listar";
      }, 3000);
  }

  function procurarPedidoNaLista(value){
    let discriminador =  value.toUpperCase();
    let someArray = listarPedidosAtivosObj.filter(x => x.nome.toUpperCase().includes(discriminador));
    document.getElementById('card'+someArray[0].codPedido).scrollIntoView();

    console.log(someArray);
    //alert("Dentro do Listar:"+value);
  }

  function atualizarStatusDoPedido(codPedido, nextstatus) {
    //console.log("codPedido: " + codPedido + " nextstatus: " + nextstatus);

    dadosNextStatus ={};
    dadosNextStatus.codPedido = codPedido,
    dadosNextStatus.nextstatus = nextstatus;

    var frm_mail_data = new FormData();
    //frm_mail_data.append('totalFinal', totalFinal);
    frm_mail_data.append('dadosNextStatus', JSON.stringify(dadosNextStatus));

    var obj = JSON.parse(frm_mail_data.get('dadosNextStatus'));
    console.log(obj);

    $.ajax({
      url: "controladores/pedidos/update.pedido.php",
      data: frm_mail_data,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(result) {
        //console.log ("result:" + result);
        var saida = document.getElementById('insertPedidoSucess'+codPedido);
        if (result) {
          saida.innerHTML = '<div  class="col-md-12  alert alert-success" role="alert">Update com sucesso!</div>';
          redirectTimeFunction();
        } else {
          saida.innerHTML = '<div  class="col-md-12  alert alert-danger" role="alert">Não foi possível salvar o Update pedido!</div>';
        }
      }
    });
 
  }
</script>