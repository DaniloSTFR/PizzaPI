<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listar</li>
  </ol>
</nav>

<?php
  include('model/clientes/clientes.class.php');

  $clientes = new Clientes();
  $listarDeClientes = $clientes -> listarClientes();
  //var_dump($saida);
  //print_r($saida); 

  echo "
  <table class='table table-striped'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>NOME</th>
        <th scope='col'>TELEFONE</th>
        <th scope='col'>OPÇÕES</th>
      </tr>
    </thead>
    <tbody>";

    $i = 1;
	foreach ($listarDeClientes as &$value){
    echo "<tr>";
      echo "<th scope='row'>".$i."</th>";
      echo "<td>".$value->getNome()."</td>";
      echo "<td>".$value->getTelefone()."</td>";
			echo "<td>";
				echo '<a class="btn btn-danger" href="?controladores=clientes&acao=listar&excluir=1&id='.$value->getCodCliente().'">Excluir</a> ';
				echo '<a class="btn btn-warning" href="?controladores=clientes&acao=listar&editar=1&id='.$value->getCodCliente().'">Editar</a>';
			echo "</td>"; 
    echo "</tr>";
    $i++;
    
	}
  echo "</tbody>
  </table>";
?>