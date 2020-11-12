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

    function listarItensTodosPedidosAtivos(){
        $conexao = new Conexao();
        $novoPedido = new PedidoDTO();
        $novoItensPedido = new ItensPedidoDTO();

        $query  = " SELECT "; 
        $query  .= " PI.codPedido, PRT.codProdutos, PRT.nomeProduto, PI.quatidade, PI.observacaoItem, ";
        $query  .= " TP.codTipoProduto,TP.descricaoTipo, PI.valorFinal ";
        $query  .= " FROM pizzapi.pedido AS P";
        $query  .= " INNER JOIN pizzapi.itenspedido AS PI ON PI.codPedido = P.codPedido";
        $query  .= " INNER JOIN pizzapi.produtos AS PRT ON PRT.codProdutos = PI.codProdutos";
        $query  .= " INNER JOIN pizzapi.tipoproduto AS TP ON PRT.codTipoProduto = TP.codTipoProduto";
        $query  .= " WHERE ";
        $query  .= " P.dataEntrega IS NULL ";
        $query  .= " AND P.dataExclusao IS NULL;";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result->num_rows > 0)  {
            return $this->getFetchObject();
        } else{
            return  (FALSE);
        }
        
    }

    function listarTodosPedidosAtivos(){
        $conexao = new Conexao();

        $query   = " SELECT  ";
        $query  .= " P.codPedido, CL.codCliente, SP.codStatusPedido, SP.statusDescricao,CL.nome, CL.telefone, ";
        $query  .= " P.valorPedido, P.dataCriacao";
        $query  .= " FROM pizzapi.pedido AS P";
        $query  .= " LEFT JOIN pizzapi.cliente AS CL ON CL.codCliente = P.codCliente";
        $query  .= " INNER JOIN pizzapi.statuspedido AS SP ON SP.codStatusPedido = P.codStatusPedido";
        $query  .= " WHERE ";
        $query  .= " P.dataEntrega IS NULL ";
        $query  .= " AND P.dataExclusao IS NULL ";
        $query  .= " GROUP BY SP.codStatusPedido,P.codPedido  ";
        $query  .= " ORDER BY SP.codStatusPedido,P.dataCriacao DESC; ";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result->num_rows > 0)  {
            return $this->getFetchObject();
        } else{
            return  (FALSE);
        }
    }

    function tiposDeStatusDoPedido(){
        $conexao = new Conexao();
        $query  = " SELECT codStatusPedido, statusDescricao";
        $query .= " FROM pizzapi.statuspedido;";
        
        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result->num_rows > 0)  {
            return $this->getFetchAssoc();
        } else{
            return  (FALSE);
        }
    }

    function alterarStatusDoPedido($dadosNextStatusDecode){

        $codPedido = $dadosNextStatusDecode->codPedido;
        $proximoStatus = $dadosNextStatusDecode->nextstatus;

        $conexao = new Conexao();

        $codPedidoSQL = mysqli_real_escape_string( $conexao->getConexao(),$codPedido);
        $proximoStatusSQL = mysqli_real_escape_string($conexao->getConexao(),$proximoStatus);

        $query  = " UPDATE pizzapi.pedido SET ";
        $query .= " codStatusPedido =".$proximoStatusSQL;
        $query .= " WHERE codPedido =".$codPedidoSQL. "; "; 

        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result !== TRUE)  {
            return FALSE;
        } else{
            return  TRUE ;
        }


    }

    function cancelarPedido($codPedido,$codUsuario){

        $conexao = new Conexao();

        $codPedidoSQL = mysqli_real_escape_string( $conexao->getConexao(),$codPedido);
        $codUsuarioSQL = mysqli_real_escape_string($conexao->getConexao(),$codUsuario);

        $query  = " UPDATE pizzapi.pedido ";
        $query .= " SET ";
        $query .= " codStatusPedido = 6, ";
        $query .= " codUsuarioExclusao = ".$codUsuarioSQL.", ";
        $query .= " dataExclusao =  CURRENT_TIMESTAMP() ";
        $query .= " WHERE codPedido = ".$codPedidoSQL."; ";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result !== TRUE)  {
            return FALSE;
        } else{
            return  TRUE ;
        }
    }

    function getFetchAssoc(){
        return mysqli_fetch_assoc($this->result);
    }

    function getFetchObject(){
        $lista = array();
        while ($obj = $this->result->fetch_object()) {
            array_push($lista,$obj);
        }
        $this->result->close();
        return $lista; 
    }


}

/* $cliente = new Clientes();
$saida = $cliente -> inserirCliente('danilo santos','91999999','TV 25 JUNHO', '138', 'GUAMÁ', 'CASA A');
var_dump($saida); */
//echo ('<script> console.log ("Saida: '. $saida.'") </script>');
  
?>