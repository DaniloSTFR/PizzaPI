<?php
    include_once('../../model/clientes/clientes.class.php');

    if(!empty($_POST['acao'])){

        $discriminador = $_POST['acao'];
        $cliente = new Clientes();
        $sucesso;

        if( $discriminador =='editarcadastro'){
            $codClientePost = $_POST['codCliente'];
            $codEnderecoPost = $_POST['codEndereco'];
            $name = strtoupper($_POST["nomeCliente"]);
            $telefone =  $_POST["telefone"];
            $logradouro =  strtoupper($_POST["endereco"]);
            $numero =  $_POST["numero"];
            $bairro =  strtoupper($_POST["bairro"]);
            $complemento = strtoupper($_POST["complemento"]);
            $cep =$_POST["cep"];
          
            $sucesso =  $cliente->editarcadastro($codClientePost, $codEnderecoPost, $name, $telefone, $logradouro, $numero, $bairro, $complemento, $cep);        
            $saida = $sucesso;
        }
        
        echo($saida);
        exit(0);
    }


?>