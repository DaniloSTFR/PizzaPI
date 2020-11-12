<?php

/* include('model/conexao.class.php');*/
//include('model/DTO/enderecoDTO.class.php');
if(!@include_once("model/DTO/enderecoDTO.class.php")){
    include_once('../../model/DTO/enderecoDTO.class.php');
} 

//include('../../model/conexao.class.php');
//include('../../model/DTO/enderecoDTO.class.php'); 
/*usar esse configuração de pasta apenas para teste inidividual*/

class Enderecos{

    private $resultEnd;
    private $listaEnderecos = array();

    function __construct() {
    }

    function inserirEndereco($logradouro, $numero, $bairro, $complemento, $cep, $codCliente){
        $conexao = new Conexao();
        $novoEndereco = new EnderecoDTO();
        
        $logradouroSQL = mysqli_real_escape_string($conexao->getConexao(), $logradouro);
        $numeroSQL = mysqli_real_escape_string($conexao->getConexao(), $numero);
        $bairroSQL = mysqli_real_escape_string($conexao->getConexao(), $bairro);
        $complementoSQL = mysqli_real_escape_string($conexao->getConexao(), $complemento);
        $cepSQL = mysqli_real_escape_string($conexao->getConexao(), $cep);
        $codClienteSQL = mysqli_real_escape_string($conexao->getConexao(), $codCliente);

        $query  = "INSERT INTO pizzapi.endereco ";
        $query .= "(logradouro,numero,bairro,complemento, cep, codCliente) VALUES ";
        $query .= " ('".$logradouroSQL."', '".$numeroSQL."', '".$bairroSQL."', '".$complementoSQL."', '".$cepSQL."',  '".$codClienteSQL."'); ";

        $this->resultEnd = mysqli_query($conexao->getConexao(), $query);
        $last_id = $conexao->getConexao()->insert_id;

        //$conexao->close();

        if ($this->resultEnd !== TRUE) {
          return false;
         } 

        $novoEndereco->setCodEndereco($last_id);
        $novoEndereco->setLogradouro($logradouro);
        $novoEndereco->setBairro($bairro);
        $novoEndereco->setComplemento($complemento);
        $novoEndereco->setNumero($numero);
        $novoEndereco->setCep($cep);
        $novoEndereco->setCodCliente($codCliente);

        return $novoEndereco;
    }

    function editarEndereco($codEnderecoPost,$logradouro, $numero, $bairro, $complemento, $cep, $codCliente){
        $conexao = new Conexao();
        
        $codEnderecoSQL = mysqli_real_escape_string($conexao->getConexao(), $codEnderecoPost); 
        $logradouroSQL = mysqli_real_escape_string($conexao->getConexao(), $logradouro);
        $numeroSQL = mysqli_real_escape_string($conexao->getConexao(), $numero);
        $bairroSQL = mysqli_real_escape_string($conexao->getConexao(), $bairro);
        $complementoSQL = mysqli_real_escape_string($conexao->getConexao(), $complemento);
        $cepSQL = mysqli_real_escape_string($conexao->getConexao(), $cep);
        $codClienteSQL = mysqli_real_escape_string($conexao->getConexao(), $codCliente);

        $query  = " UPDATE pizzapi.endereco SET";
        $query .= " logradouro = '".$logradouroSQL."', ";
        $query .= " numero = '".$numeroSQL."', ";
        $query .= " bairro = '".$bairroSQL."', ";
        $query .= " complemento = '".$complementoSQL."', ";
        $query .= " cep = '".$cepSQL."' ";
        $query .= " WHERE codEndereco = ".$codEnderecoSQL." AND codCliente = ".$codClienteSQL." ; ";

        $this->resultEnd = mysqli_query($conexao->getConexao(), $query);

        if ($this->resultEnd !== TRUE) {
          return false;
         }

        return true;
    }

    function getFetchAssoc(){
        return mysqli_fetch_assoc($this->result);
    }

}

/* $cliente = new Endereco();
$saida = $cliente -> inserirCliente('danilo santos','91999999');
var_dump($saida); */
//echo ('<script> console.log ("Saida: '. $saida.'") </script>');
  
?>