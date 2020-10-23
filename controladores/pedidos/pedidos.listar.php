<?php
include_once('model/pedidos/pedidos.class.php');

$discriminador = "";
$discriminadorAtivo = 0;

if (!empty($_GET['discriminador'])) {
  $discriminador = $_GET['discriminador'];
  $discriminadorAtivo = 1;
}
/* 
$pedidos = new Pedidos();

$sucessoPedidosAtivos = $pedidos->listarTodosPedidosAtivos();
$listaPedidosAtivos = array();
$listaPedidosAtivosPorFiltro = array();

if ($sucessoPedidosAtivos) {
  $listaPedidosAtivos = $sucessoPedidosAtivos;
  //print_r ($listaPedidosAtivos);
  if (strlen($discriminador) > 0) {
    $listaPedidosAtivosPorFiltro = arrayItemFilterPorNome('nome', $discriminador, $listaPedidosAtivos);
  } else {
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
} */

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
    <div id="listcard">

    </div>
  </div>

  <div class="col-md-2 themed-grid-col"></div>

</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript">


  var listarPedidosAtivosObj = [];
  var listaItensPedidosAtivosObj = [];

  if(<?php echo $discriminadorAtivo;?>){
    Promise.resolve()
      .then(() => obterlistaPedidosAtivos())
      .then(() => obterlistaItensPedidosAtivos())
      .then(() => procurarPedidoNaLista('<?php echo $discriminador;?>'));
  }
  else{
   Promise.resolve()
      .then(() => obterlistaPedidosAtivos())
      .then(() => obterlistaItensPedidosAtivos())
      .then(() => preencherComOsPedidosNaLista());
  }

  function setlistarPedidosAtivosObj(value){
    listarPedidosAtivosObj = JSON.parse(value);
    //console.log ("setlistarPedidosAtivosObj:" +listarPedidosAtivosObj);
  }

  function setlistaItensPedidosAtivosObj(value){
    listaItensPedidosAtivosObj = JSON.parse(value);
    //console.log ("setlistaItensPedidosAtivosObj"+listaItensPedidosAtivosObj);
  }

  function cancelarPedido() {
    console.log("Botão clicado");
  }

  async function obterlistaPedidosAtivos(){
    //console.log("obterlistaPedidosAtivos");
    var frm = new FormData();
    frm.append('acao', 'obterpedidos');

    await $.ajax({
        url: "controladores/pedidos/updatepedido.listar.php",
        data: frm,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: async function(result) {
          if (result) {
           
          } else {
            alert("Erro ao obter os dados!");
          }
        }
      })
      .done(function (result) {
        setlistarPedidosAtivosObj(result);
      })
      .fail(function() {
        alert("Erro ao obter os dados!");
      });
  }

  async function obterlistaItensPedidosAtivos(){
    //console.log ("obterlistaItensPedidosAtivos");
    var frm = new FormData();
    frm.append('acao', 'obteritenspedidos');

    await $.ajax({
        url: "controladores/pedidos/updatepedido.listar.php",
        data: frm,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: async function(result) {
          if (result) {
            //await setlistaItensPedidosAtivosObj(result);
          } else {
            alert("Erro ao obter os dados!");
          }
        }
      })
      .done(function (result) {
        setlistaItensPedidosAtivosObj(result);
      })
      .fail(function() {
        alert("Erro ao obter os dados!");
      });
  }


  function redirectTimeFunction() {
    console.log("Contando");
    setTimeout(function() {
      window.location.href = "?controladores=pedidos&acao=listar";
    }, 3000);
  }
  
  function preencherComOsPedidosNaLista() {
    let divlistcard = document.getElementById('listcard');
    console.log('Construindo...');
    divlistcard.innerHTML = "";
    divlistcard.innerHTML = gerarCardPedidos(listarPedidosAtivosObj);

  }

  function procurarPedidoNaLista(value) {
    console.log ("procurarPedidoNaLista");
    let discriminador = value.toUpperCase();
    let divlistcard = document.getElementById('listcard');
    divlistcard.innerHTML = "";
    let someArray = listarPedidosAtivosObj.filter(x => x.nome.toUpperCase().includes(discriminador));

    if (someArray.length > 0) {
      divlistcard.innerHTML = gerarCardPedidos(someArray);
    }else {
      divlistcard.innerHTML = "<div class='form-group col-md-6'><h5>Não há pedidos...</h5><br></div>";
    }
  }

  function atualizarStatusDoPedido(codPedido, nextstatus) {
    //console.log("codPedido: " + codPedido + " nextstatus: " + nextstatus);

    dadosNextStatus = {};
    dadosNextStatus.codPedido = codPedido,
    dadosNextStatus.nextstatus = nextstatus;

    var frm_mail_data = new FormData();
    //frm_mail_data.append('totalFinal', totalFinal);
    frm_mail_data.append('dadosNextStatus', JSON.stringify(dadosNextStatus));

    var obj = JSON.parse(frm_mail_data.get('dadosNextStatus'));
    console.log(obj);

    $.ajax({
        url: "controladores/pedidos/updatepedido.listar.php",
        data: frm_mail_data,
        cache: false,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function(result) {
          //console.log ("result:" + result);
          var saida = document.getElementById('insertPedidoSucess' + codPedido);
          if (result) {
            saida.innerHTML = '<div  class="col-md-12  alert alert-success" role="alert">Update com sucesso!</div>';
            redirectTimeFunction();
          } else {
            saida.innerHTML = '<div  class="col-md-12  alert alert-danger" role="alert">Não foi possível salvar o Update pedido!</div>';
          }
        }
      })
      .fail(function() {
        alert("Erro ao obter os dados!");
      });
/*       .always(function() {
        alert("complete");
      }); */

  }

  function gerarCardPedidos(someArray) {
    let saida = "";
    //console.log ("d"+someArray);
    someArray.forEach(element => {

      saida += `    <div id="card${element.codPedido}"  class="card bg-light mb-3" style="max-width: 45rem;"> `;
      saida += `      <div class="card-header bg-transparent form-row "> `;
      saida += `        <div class="form-group col-md-6"> `;
      saida += `          <h5>${element.nome}</h5><br> `;
      saida += `          <span>${element.telefone}</span> `;
      saida += `        </div> `;
      saida += `        <div class="form-group col-md-2"> `;
      saida += '          <span>Data-hora: '+dateEmMysql(element.dataCriacao)+'</span> ';
      saida += `        </div> `;
      saida += `        <div class="form-group col-md-4 float-md-right"> `;
      saida += `          <button type="button" class="btn btn-danger float-md-right" onclick="cancelarPedido()"><strong>Canlcelar<br>Pedido</strong></button> `;
      saida += `        </div> `;
      saida += `      </div> `;
      saida += `      <div class="card-body form-row"> `;
      saida += `        <div class="form-group col-md-6"> `;
      saida += `          <p class="card-text">Detalhes do Pedido:<br> `;

      saida += gerarCardPedidosItens(element.codPedido);

      saida += `          </p> `;
      saida += `        </div> `;
      saida += `        <div class="container form-group col-md-6"> `;
      saida += `          <div class="row row-cols-1"> `;
      saida += `            <div class="col col-sm-12"> `;
      saida += `              <button type="button" class="btn btn-info float-md-left" onclick="cancelarPedido()">Editar<br>Pedido</button> `;
      saida += `            </div> `;
      saida += `            <div class="col col-sm-12"> `;
      saida += `              <br> `;
      saida += `            </div> `;
      saida += `            <div class="col col-sm-12"> `;
      saida += defineStatusClass(Number(element.codStatusPedido), element.statusDescricao, element.codPedido);
      saida += `            </div> `;
      saida += `          </div> `;
      saida += `        </div> `;

      saida += `      </div> `;
      saida += `      <div class="card-footer bg-transparent form-row"> `;
      saida += `        <div class="form-group col-6 col-sm-4"> `;
      saida += `          <strong>Total: R$ ${monetario(Number(element.valorPedido))}</strong> `;
      saida += `        </div> `;
      saida += `        <div class="form-group col-6 col-sm-4"> `;
      saida += `          <button type="button" class="btn btn-success float-md-right" onclick="cancelarPedido()"><strong>Entrar em contato</strong></button> `;
      saida += `        </div> `;
      saida += `        <div class="form-group col-6 col-sm-4"> `;
      saida += defineButtonStatusClass(Number(element.codStatusPedido), element.codPedido);
      saida += `        </div> `;
      saida += `      </div> `;
      saida += `      <div id="insertPedidoSucess${element.codPedido}"></div> `;
      saida += `    </div> `;

    });

    return saida;
  }

  function gerarCardPedidosItens(codPedido) {
    //console.log (listaItensPedidosAtivosObj);
    let someArray = listaItensPedidosAtivosObj.filter(x => x.codPedido == codPedido);
    let saida = "";
    someArray.forEach(element => {
      saida += `  &nbsp;&nbsp;-  <strong> ${element.quatidade}</strong>x ${element.descricaoTipo}(S)  `;
      saida += `  &nbsp;&nbsp;  : <strong> ${element.nomeProduto}</strong> <br> `;
      saida += `  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor: R$ ${monetario(Number(element.valorFinal))} <br> `;
    });
    return saida;
  }


  function defineStatusClass(codStatusPedido, statusDescricao, codPedido) {

    switch (codStatusPedido) {
      case 1:
        return (`<div id="status${codPedido}" class="alert btn-warning" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
        break;
      case 2:
        return (`<div id="status${codPedido}" class="alert btn-danger" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
        break;
      case 3:
        return (`<div id="status${codPedido}" class="alert btn-success" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
        break;
      case 4:
        return (`<div id="status${codPedido}" class="alert btn-info" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
        break;
      case 5:
        return (`<div id="status${codPedido}" class="alert btn-secondary" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
        break;
      default:
        return (`<div id="status${codPedido}" class="alert btn-dark" role="alert"><strong>Status do Pedido: ${statusDescricao}</strong></div>`);
    }
  }

  function defineButtonStatusClass(codStatusPedido, codPedido) {
    switch (codStatusPedido) {
      case 1:
        return (`<button id="statusButton${codPedido}"  type="button" class="btn btn-outline-danger float-md-right" onclick="atualizarStatusDoPedido(${codPedido},2)"><strong>Enviar para produção</strong></button>`);
        break;
      case 2:
        return (`<button id="statusButton${codPedido}" type="button" class="btn btn-outline-success float-md-right" onclick="atualizarStatusDoPedido(${codPedido},3)"><strong>O pedido está Pronto</strong></button>`);
        break;
      case 3:
        return (`<button id="statusButton${codPedido}" type="button" class="btn btn-outline-info float-md-right" onclick="atualizarStatusDoPedido(${codPedido},4)"><strong>Enviar para entrega</strong></button>`);
        break;
      case 4:
        return (`<button id="statusButton${codPedido}" type="button" class="btn btn-outline-secondary float-md-right" onclick="atualizarStatusDoPedido(${codPedido},5)"><strong>Pedido concluído</strong></button>`);
        break;
      case 5:
        return (`<button id="statusButton${codPedido}" type="button" class="btn btn-outline-warning float-md-right" onclick="atualizarStatusDoPedido(${codPedido},1)"><strong>Reativar pedido</strong></button>`);
        break;
      default:
        return (`<button id="statusButton${codPedido}" type="button" class="btn btn-outline-dark" float-md-right" onclick="atualizarStatusDoPedido(${codPedido},6)"><strong>Cancelar Pedido</strong></button>`);
    }
  }

  function monetario(numero) {
    var dinheiro = numero.toLocaleString('pt-br', {
      style: 'currency',
      currency: 'BRL'
    });
    return dinheiro;
  }

  function dateEmMysql(dateSql)
  {
    let ano = dateSql.substr(0, 4);
    let mes = dateSql.substr(5, 2);
    let dia = dateSql.substr(8, 2);

    let hora = dateSql.substr(10);
    return dia + "/" + mes + "/" + ano + " " + hora;
    //return ano;
  }


</script>