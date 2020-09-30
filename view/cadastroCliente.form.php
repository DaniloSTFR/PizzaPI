
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
      
      <form action="?controladores=clientes&acao=inserir" method='post' >

        <div class="form-group">
          <label for="nomeCliente">Nome Completo</label>
          <input name="nomeCliente" type="text" class="form-control" id="nomeCliente" value = "<?php echo $name; ?>" <?php echo $readonly; ?>>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="cep">CEP</label>
            <input name="cep" type="text" class="form-control" id="cep" placeholder="66666-000" pattern="[0-9]{5}-[0-9]{3}" value = "<?php echo $cep; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group col-md-6">
            <label for="telefone">WhatsApp</label>
            <input name="telefone" type="text" class="form-control" id="telefone" placeholder="91-99999-9999" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" value = "<?php echo $telefone; ?>" <?php echo $readonly; ?>>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-10">
            <label for="endereco">Endereço</label>
            <input name="endereco" type="text" class="form-control" id="endereco" value = "<?php echo $logradouro; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group col-md-2">
            <label for="numero">Número</label>
            <input name="numero" type="text" class="form-control" id="numero" value = "<?php echo $numero; ?>" <?php echo $readonly; ?>>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="bairro">Bairro</label>
            <input name="bairro" type="text" class="form-control" id="bairro" value = "<?php echo $bairro; ?>" <?php echo $readonly; ?>>
          </div>
          <div class="form-group col-md-8">
            <label for="complemento">Complemento</label>
            <input name="complemento" type="text" class="form-control" id="complemento" value = "<?php echo $complemento; ?>" <?php echo $readonly; ?> >
          </div>
        </div>
        <div class="form-group float-md-right">
          <button type="submit" class="btn btn-success " <?php echo $hiddenDisable;?> >Salvar dados</button>
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