<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Usuários</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listar</li>
  </ol>
</nav>

<?php
  include('model/usuarios/usuarios.class.php');

  $usuarios = new Usuarios();
  $listarDeUsuarios = $usuarios -> listarUsuarios();
  //var_dump($saida);
  //print_r($saida); 

  echo "
  <table class='table table-striped'>
    <thead class='thead-dark'>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>LOGIN</th>
        <th scope='col'>NOME</th>
        <th scope='col'>CARGO</th>
        <th scope='col'>OPÇÕES</th>
      </tr>
    </thead>
    <tbody>";

    $i = 1;
	foreach ($listarDeUsuarios as &$value){
    echo "<tr>";
      echo "<th scope='row'>".$i."</th>";
      echo "<td>".$value->getLogin()."</td>";
      echo "<td>".$value->getNome()."</td>";
      echo "<td>".$value->getDescricaoCargos()."</td>";
			echo "<td>";
				echo '<a class="btn btn-danger" href="?controladores=usuarios&acao=listar&excluir=1&id='.$value->getCodUsuario().'">Excluir</a> ';
				echo '<a class="btn btn-warning" href="?controladores=usuarios&acao=listar&editar=1&id='.$value->getCodUsuario().'">Editar</a>';
			echo "</td>"; 
    echo "</tr>";
    $i++;
    
	}
  echo "</tbody>
  </table>";
?>