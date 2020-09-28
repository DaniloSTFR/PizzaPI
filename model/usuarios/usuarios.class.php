<?php 
include('model/conexao.class.php');
include('model/DTO/usuarioDTO.class.php');


class Usuarios{
    private $result;
    private $listaUsuarios = array();

    function __construct() {
    }

    function listarUsuarios(){
        $conexao = new Conexao(); 

        $query  = 'SELECT U.codUsuario, U.nome, U.login, U.codCargos, C.descricaoCargos ';
        $query .= 'FROM pizzapi.usuario AS U ';
        $query .= 'INNER JOIN pizzapi.cargos as C on U.codCargos = C.codCargos ';

        $this->result = mysqli_query($conexao->getConexao(), $query);

        while($row = mysqli_fetch_array($this->result) ){
            $usuario = new UsuarioDTO();

            $usuario->setCodUsuario($row['codUsuario']); 
            $usuario->setLogin($row['login']); 
            $usuario->setNome($row['nome']); 
            $usuario->setCodCargos($row['codCargos']);     
            $usuario->setDescricaoCargos($row['descricaoCargos']);      
            
            array_push($this->listaUsuarios,$usuario);

        }

        return ($this->listaUsuarios);
    }

}

/* $produtos = new Produtos();
$saida = $produtos -> listarProdutos();
var_dump($saida);
print_r($saida); */

?>