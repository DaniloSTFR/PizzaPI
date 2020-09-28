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

    private $endereco; 
    function setEndereco($valor){
        $this->endereco = $valor;
    }
    function getEndereco(){
       return $this->endereco;
    }


    private $listaEnderecos; 
    function setListaEnderecos($valor){
        $this->listaEnderecos = $valor;
    }
    function getListaEnderecos(){
       return $this->codEndelistaEnderecosreco;
    }

}
?>