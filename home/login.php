<?php include '../includes/header.php';?>

<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>

<div class="login-form">
    <form action="acoes.php" method="post">
    <input type='hidden' name='action' value='login'>
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Usuário" required="required" name='user_email'>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Senha" required="required" name='user_password'>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Logar</button>
        </div>      
    </form>
    <p class="text-center"><a href="cadastro.php">Criar uma Conta</a></p>
</div>

<?php include '../includes/footer.php';?>