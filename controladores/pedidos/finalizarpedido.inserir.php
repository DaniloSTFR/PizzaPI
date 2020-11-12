<?php 
    include_once('../../model/pedidos/pedidos.class.php');
    

    if(!empty($_POST['dadospedidojson'])){
        $dadospedidojsonDecode=json_decode ($_POST['dadospedidojson']);

        $pedidos = new Pedidos();
        $sucesso = $pedidos ->inserirPedido($dadospedidojsonDecode);
        $saida = 0;
        if($sucesso){
            $saida = 1;
        }else{
            $saida = 0;
        }

        //var_dump($saida);
        echo($saida);
        exit(0);
     }

?>