<?php
if(!@include_once("model/conexao.class.php")){
    include_once('../../model/conexao.class.php');
}

class Administrativo {
    private $result;

    function __construct() {
    }

    function dadosBalancoPedidos(){
        $conexao = new Conexao();

        $query   = " SELECT  SP.codStatusPedido, SP.statusDescricao, ";
        $query  .= " count(P.codStatusPedido) AS 'TOTAL_POR_STATUS' , sum(P.valorPedido) AS 'SOMA_VALORES' ";
        $query  .= " FROM pedido AS P ";
        $query  .= " right JOIN statuspedido AS SP on SP.codStatusPedido = P.codStatusPedido ";
        $query  .= " group by SP.codStatusPedido ";
        $query  .= " ORDER BY   SP.codStatusPedido; ";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result->num_rows > 0)  {
            return $this->getFetchObject();
        } else{
            return  (FALSE);
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


?>