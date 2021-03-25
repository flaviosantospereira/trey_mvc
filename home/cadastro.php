<?php include '../includes/header.php';?>

<form method="POST" action="acoes.php">
<input type='hidden' name='action' value='insert'>
<div class="container">
<br><h2>Cadastrar Novo Usuário</h2><br>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="user_name">
            </div>  
        </div>        
        <div class="col-4">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="user_email">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="pwd">Senha:</label>
                <input type="password" class="form-control" name="user_password">
            </div>
        </div>
        <div class="col-sm-12">
        <div class="checkbox">
            <label><input type="checkbox" name="user_role"> Usuário Master</label>
        </div>        
        <button type="submit" class="btn btn-success">Cadastrar</button>
</form>

<?php include '../includes/footer.php';?>