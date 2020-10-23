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

    <form id="frm_pedido" action="" method="post">
      <!-- <form> -->

      <div class="form-group">
        <label for="listaProdutos">Produtos</label>
        <select multiple class="form-control" name="listaProdutos" id="listaProdutos" onChange='selectItem()'>
          <?php
          $i = 1;
          foreach ($listarDeProdutos as &$value) {
            echo "<option value='" . $value->getCodProdutos() . "'  ";
            echo " data-toggle='tooltip' data-placement='right' title='" . $value->getDescricaoProduto() . "' > ";
            echo $value->getDescricaoTipo() . " -- " . $value->getNomeProduto() . " -- R$" . $value->getValor();
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
          <label for="itemqX">Quantidade:</label>
          <p id="itemqX" class="float-md-right">X</p>
          <!-- <input name="itemqtd" type="text" class="form-control" id="itemqtd" value=""> -->
        </div>
        <div class="form-group col-md-2">
          <label for="itemqtd">&nbsp;&nbsp;</label>
          <input name="itemqtd" type="text" class="form-control align-items-end" id="itemqtd" value="">
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
          <table id="itemPedidosTable" class="table table-striped" name="itemPedidosTable">
            <tbody>

            </tbody>

          </table>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-12">
          <h4 id="totalfinal" class="float-md-right text-right">Total: R$ 0,00</h4>
        </div>
      </div>

      <div class="form-group float-md-right">
        <!-- <button type="submit" class="btn btn-success btn-lg"><strong>Finalizar Pedido</strong></button> -->
        <button type="button" id="btfinalizarPedido" name="btfinalizarPedido" value="btfinalizarPedido" class="btn btn-success btn-lg"><strong>Finalizar Pedido</strong></button>
      </div>

    </form>
    <div id="insertPedidoSucess" class="form-row">
      <!-- Falha ou sucesso na inserção -->
    </div>
  </div>

  <div class="col-md-3 themed-grid-col"></div>

</div>