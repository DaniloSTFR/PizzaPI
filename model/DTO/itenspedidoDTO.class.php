<?php 
class ItensPedidoDTO {

    private $codPedido; 
    function setCodPedido($valor){
        $this->codPedido = $valor;
    }
    function getCodPedido(){
       return $this->codPedido;
    }

    private $codProdutos; 
    function setCodProdutos($valor){
        $this->codProdutos = $valor;
    }
    function getCodProdutos(){
       return $this->codProdutos;
    }

    private $quantidade; 
    function setQuantidade($valor){
        $this->quantidade = $valor;
    }
    function getQuantidade(){
       return $this->quantidade;
    }

    private $valorFinal; 
    function setValorFinal($valor){
        $this->valorFinal = $valor;
    }
    function getValorFinal(){
       return $this->valorFinal;
    }

    private $observacaoItem; 
    function setObservacaoItem($valor){
        $this->observacaoItem = $valor;
    }
    function getObservacaoItem(){
       return $this->observacaoItem;
    }

}
?>