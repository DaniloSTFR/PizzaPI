  <?php
  session_start();
  include('conexao.php');
  ?>

  <!DOCTYPE html>

  <html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login PizzaPI</title>

    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Estilos customizados para esse template -->
    <link href="https://getbootstrap.com.br/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form action='login.php' method='post' class="form-signin">
      <h1 class="h3 mb-3 font-weight-normal">Faça login</h1>
      <label for="inputUsuario" class="sr-only">Usuario</label>
      <input type="text" name = 'login' id="inputUsuario" class="form-control" placeholder="Usuario" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name = 'senha' id="inputPassword" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    </form>
  </body>
  </html>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>