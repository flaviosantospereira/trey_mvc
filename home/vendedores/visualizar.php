<?php include '../../includes/header.php';
require_once '../../models/Salesman.php';
if(!isset($_GET['salesman_id']) || $_GET['salesman_id'] == ""){
    Session::setMessage('Vendedor não encontrado.','warning');
    Session::redirect('/home/vendedores/lista.php');
    exit();
}

    $id = $_GET['salesman_id'];
    $salesman = new Salesman();
    if(!$data = $salesman->read($id)){
        Session::setMessage('Vendedor não encontrado.','warning');
        Session::redirect('/home/vendedores/lista.php');
        exit();
    }

?>

<form method="POST" action="./acoes.php?salesman_id=<?=$data['salesman_id']?>" >
<input type='hidden' name='action' value='update'>
<div class="container">
<br><h2>Cadastrar Vendedor</h2><br>
    <div class="row">
        <div class="col-4">
        <label for="salesman_id">Nome</label> 
        <input type="text" class="form-control" name="salesman_name" value="<?=$data['salesman_name']?>"/>
        </div>    
        <div class="col-4">
        <label for="salesman_id">E-mail</label> 
            <input type="email" name="salesman_email" class="form-control"  value="<?=$data['salesman_email']?>" />
        </div>    
                   
        <div class="col-sm-12">
        <hr>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </div>
</div>
</form>

<?php include '../../includes/footer.php';?>