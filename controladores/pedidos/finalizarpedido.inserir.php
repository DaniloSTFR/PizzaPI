<?php 
    include_once('../../model/pedidos/pedidos.class.php');
    

    if(!empty($_POST['dadospedidojson'])){
        $dadospedidojsonDecode=json_decode ($_POST['dadospedidojson']);

        $pedidos = new Pedidos();
        $sucesso = $pedidos ->inserirPedido($dadospedidojsonDecode);
        $saida = "";
        if($sucesso){
            $saida = true;
        }else{
            $saida = false;
        }

        //var_dump($saida);
        echo($saida);
        exit(0);
     }

?>