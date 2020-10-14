<?php

//include_once('../../model/conexao.class.php');
//include('../../model/DTO/pedidoDTO.class.php'); 
//include('../../model/DTO/itenspedidoDTO.class.php'); 

if(!@include_once("model/conexao.class.php")){
    include_once('../../model/conexao.class.php');
}
if(!@include_once("model/itenspedido/itenspedido.class.php")){
    include_once('../../model/itenspedido/itenspedido.class.php');
}
if(!@include_once("model/DTO/pedidoDTO.class.php")){
    include_once('../../model/DTO/pedidoDTO.class.php');
}
if(!@include_once("model/DTO/itenspedidoDTO.class.php")){
    include_once('../../model/DTO/itenspedidoDTO.class.php');
}

class Pedidos{

    private $result;
    private $dadospedido;
    private $dadosItenspedidos = array();

    function __construct() {
    }

    function inserirPedido($dadospedido){
        $conexao = new Conexao();
        $novoPedido = new PedidoDTO();
        $novoItensPedido = new ItensPedidoDTO();

        $codCliente = mysqli_real_escape_string( $conexao->getConexao(),$dadospedido->codCliente);
        $codUsuarioRegistro = mysqli_real_escape_string($conexao->getConexao(),$dadospedido->codUsuarioRegistro);
        $valorPedido = mysqli_real_escape_string($conexao->getConexao(),$dadospedido->valorPedido);

        $query  = "INSERT INTO pizzapi.pedido ";
        $query .= "(codStatusPedido, codCliente, codUsuarioRegistro, dataCriacao, valorPedido) VALUES (";
        $query .= "1,";// 1 - NOVO PEDIDO
        $query .= $codCliente.",";
        $query .= $codUsuarioRegistro.",";
        $query .= "CURRENT_TIMESTAMP(),";
        $query .= $valorPedido.");" ;

        //echo ('<script> console.log ("'.$query.'") </script>');
        $this->result = mysqli_query($conexao->getConexao(), $query);
        $last_id = $conexao->getConexao()->insert_id;

        $validadeInsertItens = $this->inserirItensDoPedido($dadospedido->itensPedidos, $last_id); 

        if ($this->result !== TRUE)  {
            return false;
        } else{
            return  $validadeInsertItens ;
        }
 
    }

    function inserirItensDoPedido($dadositenspedido, $codPedido){
        $itenspedido = new ItensPedido();
        return  $itenspedido->inserirItensDoPedido($dadositenspedido, $codPedido);
    }

    function listarTodosPedidos(){
    }

    function bucarPedidosDTO($cliente){
        

    }

    function getFetchAssoc(){
        return mysqli_fetch_assoc($this->result);
    }

}

/* $cliente = new Clientes();
$saida = $cliente -> inserirCliente('danilo santos','91999999','TV 25 JUNHO', '138', 'GUAMÁ', 'CASA A');
var_dump($saida); */
//echo ('<script> console.log ("Saida: '. $saida.'") </script>');
  
?>