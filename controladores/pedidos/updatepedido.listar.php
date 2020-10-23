<?php 
    include_once('../../model/pedidos/pedidos.class.php');
    

    if(!empty($_POST['dadosNextStatus'])){
        $dadosNextStatusDecode=json_decode ($_POST['dadosNextStatus']);

        $pedidos = new Pedidos();
        $sucesso = $pedidos ->alterarStatusDoPedido($dadosNextStatusDecode);
        $saida;
        if($sucesso){
            $saida = true;
        }else{
            $saida = false;
        }

        echo($saida);
        exit(0);
    }

    if(!empty($_POST['acao'])){

        $discriminador = $_POST['acao'];
        $pedidos = new Pedidos();
        $sucesso;

        if( $discriminador =='obterpedidos'){
            $sucesso = $pedidos ->listarTodosPedidosAtivos();
        }
        if( $discriminador =='obteritenspedidos'){
            $sucesso = $pedidos ->listarItensTodosPedidosAtivos();
        }
        $saida = json_encode($sucesso);
        echo($saida);
        exit(0);
    }
