<?php

include('model/conexao.class.php');
include('model/enderecos/enderecos.class.php');
include('model/DTO/clienteDTO.class.php'); 

/* include('../../model/conexao.class.php');
include('../../model/endereco/endereco.class.php');
include('../../model/DTO/clienteDTO.class.php');  */
/*usar esse configuração de pasta apenas para teste inidividual*/

class Clientes{

    private $result;
    private $listaClientes = array();

    function __construct() {
    }

    function inserirCliente($nome, $telefone, $logradouro, $numero, $bairro, $complemento, $cep){
        $conexao = new Conexao();
        $novoCliente = new ClienteDTO();


        $nomeSQL = mysqli_real_escape_string($conexao->getConexao(), $nome);
        $telefoneSQL = mysqli_real_escape_string($conexao->getConexao(), $telefone);

        $query  = "INSERT INTO pizzapi.cliente ";
        $query .= "(nome,telefone) VALUES('".$nomeSQL."' , '".$telefoneSQL."'); ";

        $this->result = mysqli_query($conexao->getConexao(), $query);
        $last_id = $conexao->getConexao()->insert_id;

       if ($this->result === TRUE) {
           // echo "New record created successfully";
          } else {
            return false;
          }
 
       // $conexao->close();

        $novoCliente->setCodCliente($last_id);
        $novoCliente->setNome($nome);
        $novoCliente->setTelefone($telefone);

        $novoEndereco = $this->inserirEnderecoCliente($logradouro, $numero, $bairro, $complemento, $cep, $last_id);
        if($novoEndereco !== FALSE){
            $novoCliente->setEndereco($novoEndereco);
        }else{
            return false;
        } 

        return $novoCliente;
    }

    function inserirEnderecoCliente($logradouro, $numero, $bairro, $complemento, $cep, $codCliente){
        $novoEndereco = new Enderecos();
        return $novoEndereco->inserirEndereco($logradouro, $numero, $bairro, $complemento, $cep, $codCliente);
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