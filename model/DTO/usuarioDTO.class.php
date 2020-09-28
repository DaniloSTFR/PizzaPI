<?php 
class UsuarioDTO {

    private $codUsuario; 
    function setCodUsuario($valor){
        $this->codUsuario = $valor;
    }
    function getCodUsuario(){
       return $this->codUsuario;
    }

    private $login;
    function setLogin($valor){
        $this->login = $valor;
    }
    function getLogin(){
       return $this->login;
    }

    private $nome; 
    function setNome($valor){
        $this->nome = $valor;
    }
    function getNome(){
       return $this->nome;
    }

    private $senha; 
    function setSenha($valor){
        $this->senha = $valor;
    }
    function getSenha(){
       return $this->senha;
    }

    private $codCargos; 
    function setCodCargos($valor){
        $this->codCargos = $valor;
    }
    function getCodCargos(){
       return $this->codCargos;
    }

    private $descricaoCargos; 
    function setDescricaoCargos($valor){
        $this->descricaoCargos = $valor;
    }
    function getDescricaoCargos(){
       return $this->descricaoCargos;
    }

}
?>