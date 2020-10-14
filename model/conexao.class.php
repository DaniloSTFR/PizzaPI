<?php

class Conexao {

    private $host = 'localhost';
    private $usuario = 'root';
    private $senha = '';
    private $db = 'pizzapi';

    private $conexao;
    
    
    function __construct() {

        $this->conexao = mysqli_connect($this->host, $this->usuario, $this->senha, $this->db);
        mysqli_set_charset ( $this->conexao , "utf8" );
        //echo ('<string> console.log ("'.$this->host.'") </string>');
        // Check connection
        if (!$this->conexao ) {
            die('<script> console.log ("Erro na Conexão'.mysqli_connect_error().'") </script>');
        }
        //echo ('<script> console.log ("Conectado com Sucesso") </script>');
      }

    function getConexao(){
        return $this->conexao;
     }
}

//$conexao = new Conexao(); 
?>