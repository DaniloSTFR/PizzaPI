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

        if ($this->result !== TRUE)  {
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

    function listarClientes(){
        $conexao = new Conexao(); 

        $query  = ' SELECT * FROM pizzapi.cliente ';

        $this->result = mysqli_query($conexao->getConexao(), $query);

        while($row = mysqli_fetch_array($this->result) ){
            $cliente= new ClienteDTO();

            $cliente->setCodCliente($row['codCliente']); 
            $cliente->setNome($row['nome']); 
            $cliente->setTelefone($row['telefone']);     
            
            array_push($this->listaClientes,$cliente);

        }

        return ($this->listaClientes);
    }

    function bucarClientesDTO($cliente){
        $conexao = new Conexao();
        $clienteDTO= new ClienteDTO();
        $enderecoDTO = new EnderecoDTO();

        $clienteSQL = mysqli_real_escape_string($conexao->getConexao(), $cliente);

        $query   = "SELECT "; 
        $query  .= "C.codCliente, C.nome, C.telefone, E.codEndereco, E.logradouro, E.numero, E.bairro, E.complemento, E.cep ";
        $query  .= "FROM pizzapi.cliente AS C ";
        $query  .= "INNER JOIN pizzapi.endereco AS E ON E.codCliente = C.codCliente ";
        $query  .= "WHERE C.codCliente =". $cliente. " ;";

        $this->result = mysqli_query($conexao->getConexao(), $query);

        while($row = mysqli_fetch_array($this->result) ){
            $clienteDTO->setCodCliente($row['codCliente']); 
            $clienteDTO->setNome($row['nome']); 
            $clienteDTO->setTelefone($row['telefone']);
            
            $enderecoDTO->setCodEndereco($row['codEndereco']);
            $enderecoDTO->setLogradouro($row['logradouro']);
            $enderecoDTO->setBairro($row['bairro']);
            $enderecoDTO->setComplemento($row['complemento']);
            $enderecoDTO->setNumero($row['numero']);
            $enderecoDTO->setCep($row['cep']);
            $enderecoDTO->setCodCliente($row['codCliente']);

            $clienteDTO->setEndereco($enderecoDTO);
            
            //array_push($this->listaClientes,$cliente);

        }

        return $clienteDTO;

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