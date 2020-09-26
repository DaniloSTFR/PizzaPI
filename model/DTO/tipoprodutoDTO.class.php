<?php 
class StatusPedidoDTO {

    private $codTipoProduto; 
    function setCodTipoProduto($valor){
        $this->codTipoProduto = $valor;
    }
    function setCodTipoProduto(){
       return $this->codTipoProduto;
    }

    private $descricaoTipo;
    function setDescricaoTipo($valor){
        $this->descricaoTipo = $valor;
    }
    function getDescricaoTipo(){
       return $this->descricaoTipo;
    }

}
?>