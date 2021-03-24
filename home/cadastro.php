<?php include '../includes/header.php';?>

<form method="POST" action="acoes.php">
<input type='hidden' name='action' value='insert'>
<div class="container">
    <div class="row">
        <div class="col-4">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" name="user_name">
        </div>        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="user_email">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" class="form-control" name="user_password">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="user_role"> Usuário Master</label>
        </div>        
  <button type="submit" class="btn btn-default">Cadastrar</button>
</form>

<?php include '../includes/footer.php';?>