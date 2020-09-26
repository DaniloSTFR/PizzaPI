<?php 
class PedidoDTO {

    private $codPedido; 
    function setCodPedido($valor){
        $this->codPedido = $valor;
    }
    function getCodPedido(){
       return $this->codPedido;
    }

    private $codCliente; 
    function setCodCliente($valor){
        $this->codCliente = $valor;
    }
    function getCodCliente(){
       return $this->codCliente;
    }

    private $codStatusPedido; 
    function setCodStatusPedido($valor){
        $this->codStatusPedido = $valor;
    }
    function getCodStatusPedido(){
       return $this->codStatusPedido;
    }

    private $codUsuarioEntrega; 
    function setCodUsuarioEntrega($valor){
        $this->codUsuarioEntrega = $valor;
    }
    function getCodUsuarioEntrega(){
       return $this->codUsuarioEntrega;
    }

    private $codUsuarioExclusao; 
    function setCodUsuarioExclusao($valor){
        $this->codUsuarioExclusao = $valor;
    }
    function getCodUsuarioExclusao(){
       return $this->codUsuarioExclusao;
    }

    private $codUsuarioRegistro; 
    function setCodUsuarioRegistro($valor){
        $this->codUsuarioRegistro = $valor;
    }
    function getCodUsuarioRegistro(){
       return $this->codUsuarioRegistro;
    }

    private $dataCriacao; 
    function setDataCriacao($valor){
        $this->dataCriacao = $valor;
    }
    function getDataCriacao(){
       return $this->dataCriacao;
    }

    private $dataEntrega; 
    function setDataEntrega($valor){
        $this->dataEntrega = $valor;
    }
    function getDataEntrega(){
       return $this->dataEntrega;
    }

    private $dataExclusao; 
    function setDataExclusao($valor){
        $this->dataExclusao = $valor;
    }
    function getDataExclusao(){
       return $this->dataExclusao;
    }


    private $valorPedido; 
    function setValorPedido($valor){
        $this->valorPedido = $valor;
    }
    function getValorPedido(){
       return $this->valorPedido;
    }

}
?>