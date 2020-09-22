<?php 
class ProdutosDTO {

    private $codProdutos; 
    function setCodProdutos($valor){
        $this->codProdutos = $valor;
    }
    function getCodProdutos(){
       return $this->codProdutos;
    }

    private $nomeProduto;
    function setNomeProduto($valor){
        $this->nomeProduto = $valor;
    }
    function getNomeProduto(){
       return $this->nomeProduto;
    }

    private $descricaoProduto; 
    function setDescricaoProduto($valor){
        $this->descricaoProduto = $valor;
    }
    function getDescricaoProduto(){
       return $this->descricaoProduto;
    }

    private $valor; 
    function setValor($valor){
        $this->valor = $valor;
    }
    function getValor(){
       return $this->valor;
    }

    private $statusAtivo;
    function setStatusAtivo($valor){
        $this->statusAtivo = $valor;
    }
    function getStatusAtivo(){
       return $this->statusAtivo;
    }

    private $codTipoProduto;
    function setCodTipoProduto($valor){
        $this->codTipoProduto = $valor;
    }
    function getCodTipoProduto(){
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