<?php 
class ClienteDTO {

    private $codCliente; 
    function setCodCliente($valor){
        $this->codCliente = $valor;
    }
    function getCodCliente(){
       return $this->codCliente;
    }

    private $nome; 
    function setNome($valor){
        $this->nome = $valor;
    }
    function getNome(){
       return $this->nome;
    }

    private $telefone; 
    function setTelefone($valor){
        $this->telefone = $valor;
    }
    function getTelefone(){
       return $this->telefone;
    }

    private $codEndereco; 
    function setCodEndereco($valor){
        $this->codEndereco = $valor;
    }
    function getCodEndereco(){
       return $this->codEndereco;
    }

}
?>