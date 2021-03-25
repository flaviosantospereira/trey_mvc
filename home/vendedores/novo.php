<?php include '../../includes/header.php';
require_once '../../models/Salesman.php';
?>

<form method="POST" action="./acoes.php" >
<input type='hidden' name='action' value='insert'>
<div class="container">
<br><h2>Cadastrar Vendedor</h2><br>
    <div class="row">
        <div class="col-4">
        <label for="salesman_id">Nome</label> 
        <input type="text" class="form-control" name="salesman_name"/>
        </div>    
        <div class="col-4">
        <label for="salesman_id">E-mail</label> 
            <input type="email" name="salesman_email" class="form-control">
        </div>    
                   
        <div class="col-sm-12">
        <hr>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </div>
</div>
</form>

<?php include '../../includes/footer.php';?>