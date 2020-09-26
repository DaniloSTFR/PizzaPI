<?php 
class EnderecoDTO {

    private $codEndereco; 
    function setCodEndereco($valor){
        $this->codEndereco = $valor;
    }
    function getCodEndereco(){
       return $this->codEndereco;
    }

    private $logradouro;
    function setLogradouro($valor){
        $this->logradouro = $valor;
    }
    function getLogradouro(){
       return $this->logradouro;
    }

    private $bairro; 
    function setBairro($valor){
        $this->bairro = $valor;
    }
    function getBairro(){
       return $this->bairro;
    }

    private $complemento; 
    function setComplemento($valor){
        $this->complemento = $valor;
    }
    function getComplemento(){
       return $this->complemento;
    }

    private $numero;
    function setNumero($valor){
        $this->numero = $valor;
    }
    function getNumero(){
       return $this->numero;
    }

}
?>