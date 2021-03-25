<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once realpath(__DIR__) . "/../session/Session.php";
$session = new Session;
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 

<!-- JS Mask -->
<script src="/trey_mvc/libs/js/mask/dist/jquery.mask.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tray Vendas</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="http://localhost/trey_mvc/includes/images/tray-logo.svg" alt="Tray Logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

<?php
if($_SERVER['SCRIPT_NAME'] != "/trey_mvc/home/login.php" && $_SERVER['SCRIPT_NAME'] != "/trey_mvc/home/cadastro.php"){
  if(!$session->auth()){
    Session::redirect('home/login.php',['message' => 'Usuario deslogado!','type' => 'danger']);
    exit();
  }
?>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
  <li class="nav-item active">
    <a class="nav-link" href="/trey_mvc/home">Home <span class="sr-only">(current)</span></a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Vendedores
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/trey_mvc/home/vendedores/lista.php">Lista de Vendedores</a>
      <a class="dropdown-item" href="/trey_mvc/home/vendedores/novo.php">Cadastrar Vendedor</a>
    </div>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Vendas
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="/trey_mvc/home/vendas/lista.php">Lista de Vendas</a>
      <a class="dropdown-item" href="/trey_mvc/home/vendas/nova.php">Cadastrar Venda</a>        
    </div>
  </li>      
</ul>
<ul class="navbar-nav">
<li class="nav-item dropdown float-right">
  <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <strong><?= Session::get('user_name') ?></strong>
  </a>
  <div class="dropdown-menu" style="margin-right:50%" aria-labelledby="navbarDropdown">
    <div class="dropdown-divider"></div>
  <form method="POST" action="/trey_mvc/home/acoes.php">
  <input type='hidden' name='action' value='logout'>
    <input type="submit" class="dropdown-item" href="#" value="Logout"/>
    </form>
  </div>
</li>
</ul>
</div>

<script>
function logout(){
    document.getElementById('logout').submit()
    }
</script>

<?php } ?>

</nav>

<?= Session::getMessage() ?>