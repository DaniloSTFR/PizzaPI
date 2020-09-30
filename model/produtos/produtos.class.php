<?php 
require_once('model/conexao.class.php');
include('model/DTO/produtosDTO.class.php');

/* include('../../model/conexao.class.php');
include('../../model/DTO/produtosDTO.class.php'); 
usar esse configuração de pasta apenas para teste inidividual*/

class Produtos{
    private $result;
    private $listaProdutos = array();

    function __construct() {
    }

    function listarProdutos($ativo){
        $conexao = new Conexao(); 

        $query  = 'SELECT ';
        $query .= 'PDT.codProdutos, PDT.nomeProduto, PDT.descricaoProduto , PDT.valor, PDT.statusAtivo, TP.codTipoProduto,TP.descricaoTipo ';
        $query .= 'FROM produtos AS PDT ';
        $query .= 'INNER JOIN tipoproduto AS TP ON TP.codTipoProduto = PDT.codTipoProduto ';
        if($ativo){
            $query .= 'WHERE PDT.statusAtivo = 1 ';
        }
        $query .= ' ORDER BY TP.descricaoTipo, PDT.nomeProduto ASC; ';

        echo ('<script> console.log ("'.$query.'") </script>');

        $this->result = mysqli_query($conexao->getConexao(), $query);

        while($row = mysqli_fetch_array($this->result) ){
            $produto = new ProdutosDTO();
            //PDT.codProdutos,
            $produto->setCodProdutos($row['codProdutos']); 
            //PDT.nomeProduto, 
            $produto->setNomeProduto($row['nomeProduto']); 
            //PDT.descricaoProduto, 
            $produto->setDescricaoProduto($row['descricaoProduto']); 
            //PDT.valor,
            $produto->setValor($row['valor']); 
            //PDT.statusAtivo, 
            $produto->setStatusAtivo($row['statusAtivo']); 
            //TP.codTipoProduto,
            $produto->setCodTipoProduto($row['codTipoProduto']); 
            //TP.descricaoTipo ';
            $produto->setDescricaoTipo($row['descricaoTipo']);
            
            array_push($this->listaProdutos,$produto);

        }

        return ($this->listaProdutos);
    }

}

/* $produtos = new Produtos();
$saida = $produtos -> listarProdutos();
var_dump($saida);
print_r($saida); */

?>