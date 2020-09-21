<?php

include('../../model/conexao.class.php');

class Login{

    private $login;
    private $senha;
    private $result;

    function __construct() {
    }

    function validacaoDeLogin($login,$senha){
        $conexao = new Conexao(); 

        //echo ('<script> console.log ("Em validadacao: '. $login.'|'.$senha.'") </script>');

        $this->login = mysqli_real_escape_string($conexao->getConexao(), $login);
        $this->senha = mysqli_real_escape_string($conexao->getConexao(), $senha);

        $query = "select nome from usuario where login = '{$this->login}' and senha = md5('{$this->senha}')";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        $row = mysqli_num_rows($this->result);

        return $row;
    }

    function getFetchAssoc(){
        return mysqli_fetch_assoc($this->result);
    }

}

//$lg = new Login();
//$saida = $lg -> validacaoDeLogin('danilo','123');
//echo ('<script> console.log ("Saida: '. $saida.'") </script>');
  
?>