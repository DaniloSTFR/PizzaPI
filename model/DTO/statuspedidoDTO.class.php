<?php 
class StatusPedidoDTO {

    private $codStatusPedido; 
    function setCodStatusPedido($valor){
        $this->codStatusPedido = $valor;
    }
    function getCodStatusPedido(){
       return $this->codStatusPedido;
    }

    private $statusDescricao;
    function setStatusDescricao($valor){
        $this->statusDescricao = $valor;
    }
    function getStatusDescricao(){
       return $this->statusDescricao;
    }

}
?>