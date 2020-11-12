<div class="row mb-3">

  <div class="col-md-3 themed-grid-col"></div>

  <div class="col-md-6 themed-grid-col">

    <?php if ($sucesso && $formPost) {  ?>
      <div class="form-row">
        <div class="col-md-12  alert alert-success" role="alert">
          Cliente <?php echo ($name . $nameErr); ?>, Cadastrado com sucesso !
          <?php  //echo ('<script type="text/javascript"> document.getElementById("formCadastro").reset();</script>')?>
        </div>
      </div>
    <?php  } else if ($formPost) { ?>
      <div class="form-row">
        <div class="col-md-12  alert alert-danger" role="alert">
          Erro no cadastrado: <?php echo ($name . $nameErr); ?> !
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
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
          </svg>
        </button>
      </div>
    </div>

    <hr>

    <form id="formCadastro" action="<?php echo $submitForm; ?>" method='post'>

      <div class="form-group">
        <label for="nomeCliente">Nome Completo</label>
        <input name="nomeCliente" type="text" class="form-control" id="nomeCliente" value="<?php echo $name; ?>" <?php echo $readonly; ?>>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="cep">CEP</label>
          <input name="cep" type="text" class="form-control" id="cep" placeholder="66666-000" pattern="[0-9]{5}-[0-9]{3}" value="<?php echo $cep; ?>" <?php echo $readonly; ?>>
        </div>
        <div class="form-group col-md-6">
          <label for="telefone">WhatsApp</label>
          <input name="telefone" type="text" class="form-control" id="telefone" placeholder="91-99999-9999" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" value="<?php echo $telefone; ?>" <?php echo $readonly; ?>>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-10">
          <label for="endereco">Endereço</label>
          <input name="endereco" type="text" class="form-control" id="endereco" value="<?php echo $logradouro; ?>" <?php echo $readonly; ?>>
        </div>
        <div class="form-group col-md-2">
          <label for="numero">Número</label>
          <input name="numero" type="text" class="form-control" id="numero" value="<?php echo $numero; ?>" <?php echo $readonly; ?>>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="bairro">Bairro</label>
          <input name="bairro" type="text" class="form-control" id="bairro" value="<?php echo $bairro; ?>" <?php echo $readonly; ?>>
        </div>
        <div class="form-group col-md-8">
          <label for="complemento">Complemento</label>
          <input name="complemento" type="text" class="form-control" id="complemento" value="<?php echo $complemento; ?>" <?php echo $readonly; ?>>
        </div>
      </div>
      <div class="form-group float-md-right">
        <button type="submit" class="btn btn-success " <?php echo $hiddenDisableCadastrar; ?>>Salvar dados</button>
        <button id="btnEditar" type="button" class="btn btn-success " <?php echo $hiddenDisableEditar; ?>>Salvar dados editados</button>
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

        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="filtroBuscar">Buscar por nome ou telefone: </label>
            <input name="filtroBuscar" type="text" class="form-control" id="filtroBuscar" value="">
          </div>
          <div class="form-group col-md-4">
            <label for="btnprocurarClientePor" class="col-md-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <button id="btnprocurarClientePor" type="button" class="btn btn-outline-success bi bi-search" onclick="procurarClientePor()"><strong>+ Procurar</strong>
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
              </svg>
          </button>
          </div>
        </div>

        <div class="form-row">
          <div id="tableClientesFiltrados" class="form-group col-md-12">

          </div>
        </div>


      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary"  onclick="procurarClientePor()">Carregar dados</button> -->
      </div>
    </div>
  </div>
</div>
 
<script src="js/jquery-2.2.4.min.js"></script> 
<!-- <script type="text/javascript" src="js/jquery.mask.js"></script> -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->

<script type="text/javascript">
  async function procurarClientePor() {
      //console.log("obterlistaPedidosAtivos");
      let divfiltroBuscar = document.getElementById('filtroBuscar');
      console.log ('divfiltroBuscar:' + divfiltroBuscar.value);
      var frm = new FormData();
      frm.append('acao', 'buscarclientes');
      frm.append('filtro', divfiltroBuscar.value);

      await $.ajax({
          url: "controladores/pedidos/update.pedido.php",
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
        .done(function(result) {
          listadeClientesFiltradosTable(result);
        })
        .fail(function() {
          alert("Erro ao obter os dados!");
        });

  }

 function listadeClientesFiltradosTable(filtrados){
    listadeClientesFiltrados = JSON.parse(filtrados);
    let divClientesFiltrados = document.getElementById('tableClientesFiltrados');
    let divfil = "";
     divfil +="<table class='table table-striped'> "
                +"<thead class='thead-dark'> "
                  +"<tr> "
                    +"<th scope='col'>#</th> "
                    +"<th scope='col'>NOME / TELEFONE</th> "
                    +"<th scope='col'>OPÇÕES</th> "
                  +"</tr> "
                +"</thead> "
                +"<tbody> ";
    let i = 1; 
    listadeClientesFiltrados.forEach(element => {
      divfil+= "<tr>";
      divfil+= "<th scope='row'>"+i+"</th>";
      divfil+= "<td>"+element.nome+"<br>"+element.telefone+"</td>";
      divfil+= "<td>";
        divfil+= '<a class="btn btn-success" href="?controladores=pedidos&acao=inserir&cliente='+element.codCliente+'">Fazer Pedido</a> ';
			divfil+= "</td>"; 
    divfil+= "</tr>";
    i++;

    });

    divfil+= "</tbody> </table>";

    divClientesFiltrados.innerHTML = divfil;
 }

 $(document).ready(function () { 
        var $campoTelefone = $("#telefone");
        $campoTelefone.mask('00-00000-0000', {reverse: true});

        var $campoCEP = $("#cep");
        $campoCEP.mask('00000-000', {reverse: true});
        //$('#telefone').mask('00-00000-0000');
    });

  </script>