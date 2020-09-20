
<?php 
  $controlador = "";
  $acao = "";

  if(!empty($_GET['controladores'])){
    $controlador = $_GET['controladores'];
  }
  
  if(!empty($_GET['acao'])){
    $acao = $_GET['acao'];
  }

  if($controlador == "pedidos"){
    if($acao == "inserir"){
      require_once("controladores/pedidos/pedidos.inserir.php");
    }else if($acao == "listar"){
      require_once("controladores/pedidos/pedidos.listar.php");
    }else if($acao == "editar"){
      require_once("controladores/pedidos/pedidos.editar.php");
    }else if($acao == "apagar"){
      require_once("controladores/pedidos/pedidos.apagar.php");
    }
  }

  
  if($controlador == "clientes"){
    if($acao == "inserir"){
      require_once("controladores/clientes/clientes.inserir.php");
    }else if($acao == "listar"){
      require_once("controladores/clientes/clientes.listar.php");
    }else if($acao == "editar"){
      require_once("controladores/clientes/clientes.editar.php");
    }else if($acao == "apagar"){
      require_once("controladores/clientes/clientes.apagar.php");
    }
  }

  
  if($controlador == "produtos"){
    if($acao == "inserir"){
      require_once("controladores/produtos/produtos.inserir.php");
    }else if($acao == "listar"){
      require_once("controladores/produtos/produtos.listar.php");
    }else if($acao == "editar"){
      require_once("controladores/produtos/produtos.editar.php");
    }else if($acao == "apagar"){
      require_once("controladores/produtos/produtos.apagar.php");
    }
  }

  
  if($controlador == "usuarios"){
    if($acao == "inserir"){
      require_once("controladores/usuarios/usuarios.inserir.php");
    }else if($acao == "listar"){
      require_once("controladores/usuarios/usuarios.listar.php");
    }else if($acao == "editar"){
      require_once("controladores/usuarios/usuarios.editar.php");
    }else if($acao == "apagar"){
      require_once("controladores/usuarios/usuarios.apagar.php");
    }
  }


?>

