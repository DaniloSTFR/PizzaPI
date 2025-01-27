<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>PizzaPI</title>


    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">PizzaPI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropPedidos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pedidos</a>
        <div class="dropdown-menu" aria-labelledby="dropPedidos">
          <a class="dropdown-item" href="?controladores=pedidos&acao=inserir">Adicionar Pedidos</a>
          <a class="dropdown-item" href="?controladores=pedidos&acao=listar">Listar Pedidos</a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropClientes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
        <div class="dropdown-menu" aria-labelledby="dropClientes">
          <a class="dropdown-item" href="?controladores=clientes&acao=inserir">Adicionar Cliente</a>
          <a class="dropdown-item" href="?controladores=clientes&acao=listar">Listar Clientes</a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropProdutos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produtos</a>
        <div class="dropdown-menu" aria-labelledby="dropProdutos">
          <a class="dropdown-item" href="?controladores=produtos&acao=inserir">Adicionar Produtos</a>
          <a class="dropdown-item" href="?controladores=produtos&acao=listar">Listar Produtos</a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropUsuarios" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuários</a>
        <div class="dropdown-menu" aria-labelledby="dropUsuarios">
          <a class="dropdown-item" href="?controladores=usuarios&acao=inserir">Adicionar Usuários</a>
          <a class="dropdown-item" href="?controladores=usuarios&acao=listar">Listar Usuários</a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>




    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Pedidos" aria-label="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Procurar</button>
    </form>
  </div>
</nav>

<main role="main" class="container">
  <?php
    require_once("controladores/menu.controlador.php");
  ?>
</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
