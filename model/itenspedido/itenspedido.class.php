<?php
if(!@include_once("model/conexao.class.php")){
    include_once('../../model/conexao.class.php');
}

if(!@include_once("model/DTO/itenspedidoDTO.class.php")){
    include_once('../../model/DTO/itenspedidoDTO.class.php');
}

class ItensPedido{
    private $result;
    private $dadosItenspedidos = array();

    function __construct() {
    }

    function inserirItensDoPedido($dadositenspedido, $codPedido){
        $conexao = new Conexao();
        $novoItensPedido = new ItensPedidoDTO();

        $query = " INSERT INTO pizzapi.itenspedido (codPedido,codProdutos,quatidade,valorFinal,observacaoItem) VALUES ";

        $i = 1;
        foreach ($dadositenspedido as &$value)  {


          $codPedidosql = mysqli_real_escape_string( $conexao->getConexao(), $codPedido);
          $codProdutos = mysqli_real_escape_string( $conexao->getConexao(),$value->codProdutos);
          $quatidade = mysqli_real_escape_string( $conexao->getConexao(),$value->quatidade);
          $valorFinal = mysqli_real_escape_string( $conexao->getConexao(),$value->valorFinal);
          $observacaoItem = mysqli_real_escape_string( $conexao->getConexao(),$value->observacaoItem);

          $query .= "(";
          $query .= $codPedidosql.",";
          $query .= $codProdutos.",";
          $query .= $quatidade.",";
          $query .= $valorFinal.",";
          $query .= "'".$observacaoItem."')" ;
          
          if($i<count($dadositenspedido)){
            $query .= "," ;
          }else{
            $query .= ";" ;
          }
          $i+=1;

        }  

        //echo ('<script> console.log ("'.$query.'") </script>');
        $this->result = mysqli_query($conexao->getConexao(), $query);

        if ($this->result !== TRUE) {
            return  false;
        } else{
            return true;
        }
        
    }

    function getFetchAssoc(){
        return mysqli_fetch_assoc($this->result);
    }

}
?>


