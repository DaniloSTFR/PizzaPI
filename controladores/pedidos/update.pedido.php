<?php 
    include_once('../../model/pedidos/pedidos.class.php');
    include_once('../../model/clientes/clientes.class.php');
    

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
        $cliente = new Clientes();
        $sucesso;

        if( $discriminador =='obterpedidos'){
            $sucesso = $pedidos ->listarTodosPedidosAtivos();
            $saida = json_encode($sucesso);
        }
        if( $discriminador =='obteritenspedidos'){
            $sucesso = $pedidos ->listarItensTodosPedidosAtivos();
            $saida = json_encode($sucesso);
        }
        if( $discriminador =='cancelarpedido'){
            $codPedidoPost = $_POST['codPedido'];
            $codUsuarioPost = $_POST['codUsuario'];
            $sucesso = $pedidos ->cancelarPedido($codPedidoPost,$codUsuarioPost);
            $saida = 1;
        }

        if( $discriminador =='buscarclientes'){
            $filtro = $_POST['filtro'];
            $sucesso = $cliente ->bucarClientesPorFiltro($filtro);
            $saida = json_encode($sucesso);
        }
        
        echo($saida);
        exit(0);
    }


?>