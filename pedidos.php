<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza</title>
</head>
<body>
<?php
    
    class PedidoPizza {
        var $quantidade;
        var $sabores = [];
        var $nomedoCliente;
        var $valorAPagar;
        var $preco;
        //var $valor;
        
        function setQuantidade($qtd){
            $this->quantidade = $qtd;
        }
        function setNomedoCliente($nome){
            $this->nomedoCliente = $nome;
        }
        function setValorAPagar($valor){
            $this->valorAPagar = $valor;
        }
        function setPreco($valor){
            $this->preco = $valor;
       }
        function setSabores($sabor,$pos){
            $this->sabores[$pos] = $sabor;
        }
        
        
        function getQuantidade(){
           return $this->quantidade;
        }
        function getNomedoCliente(){
           return $this->nomedoCliente;
        }
        function getValorAPagar(){
           return $this->valorAPagar;
        }
        function getPreco(){
            return $this->preco;
         }
        function getSabores($pos){
           return $this->sabores[$pos];
        }
                
        function calcularContaCliente(){ 
            $valor = $this->getPreco() * $this->getQuantidade();
            $this->setValorAPagar($valor);
        }

        function detalharPedido(){
            $this->calcularContaCliente();
            echo 
             "Nome do Cliente: ".$this->getNomedoCliente()."<br>";
            echo
             "Quantidade pedida: ".$this->getQuantidade()."<br>";
            echo
             "Valor a pagar: R$".$this->getValorAPagar()."<br>";
            
            var_dump($this->sabores);
        }
        
    }

    $pedido = new PedidoPizza;
    $pedido->setPreco(25);//valor por pizza

    $pedido->setNomedoCliente("Joao Pizza");
    $pedido->setquantidade(2);
    $pedido->setSabores('Calabresa', 0);    
    $pedido->setSabores('Peperone', 1);
    $pedido->detalharPedido();
    
    ?>
</body>
</html>