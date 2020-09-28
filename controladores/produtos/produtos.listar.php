<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Produtos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listar</li>
  </ol>
</nav>


<?php
  include('model/produtos/produtos.class.php');

  $produtos = new Produtos();
  $listarDeProdutos = $produtos -> listarProdutos();
  //var_dump($saida);
  //print_r($saida); 

  echo "
  <table class='table table-striped'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>NOME</th>
        <th scope='col'>DESCRIÇÃO</th>
        <th scope='col'>VALOR</th>
        <th scope='col'>TIPO</th>
        <th scope='col'>OPÇÕES</th>
      </tr>
    </thead>
    <tbody>";

    $i = 1;
	foreach ($listarDeProdutos as &$value){
    echo "<tr>";
      echo "<th scope='row'>".$i."</th>";
      echo "<td>".$value->getDescricaoTipo()."</td>";
      echo "<td>".$value->getNomeProduto()."</td>";
      echo "<td>".$value->getDescricaoProduto()."</td>";
      echo "<td>R$".$value->getValor()."</td>";
			echo "<td>";
				echo '<a class="btn btn-danger" href="?controladores=produtos&acao=listar&excluir=1&id='.$value->getCodProdutos().'">Excluir</a> ';
				echo '<a class="btn btn-warning" href="?controladores=produtos&acao=listar&editar=1&id='.$value->getCodProdutos().'">Editar</a>';
			echo "</td>"; 
    echo "</tr>";
    $i++;
    
	}
  echo "</tbody>
  </table>";



?>