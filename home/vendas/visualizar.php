<?php include '../../includes/header.php';
require_once '../../models/Sales.php';
require_once '../../models/Salesman.php';


if(!isset($_GET['sale_id']) || $_GET['sale_id'] == ""){
    Session::setMessage('Venda não encontrado.','warning');
    Session::redirect('home/vendas/lista.php');
    exit();
}
    $salesman = new Salesman();
    $list = $salesman->listAll();
    $id = $_GET['sale_id'];
    $sale = new sales();
    if(!$sale = $sale->read($id)){
        Session::setMessage('Vendedor não encontrado.','warning');
        Session::redirect('home/vendas/lista.php');
        exit();
    }
$date = new DateTime($sale['sale_date']);
$date = $date->format('Y-m-d');

?>

<script>
$(document).ready(function(){
    $('#sale_value').mask('R$ 000.000.000.000.000,00', {reverse: true});
});
</script>

<form method="POST" action="./acoes.php?sale_id=<?=$sale['sale_id']?>" >
<input type='hidden' name='action' value='update'>
<div class="container">
<br><h2>Cadastrar Nova Venda</h2><br>
    <div class="row">
        <div class="col-4">
        <label for="salesman_id">Vendedor:</label> 
        <select class="form-control" name="salesman_id">
            <option value="">Selecione</option>
            <?php foreach($list as $l){ ?>
                <option value="<?= $l['salesman_id'] ?>" <?php $l['salesman_id'] == $sale['salesman_id'] ? print('selected="selected"') : '' ?> ><?=$l['salesman_name'] ?></option><?php } ?>
        </select>
        </div>    
        <div class="col-4">
            <div class="form-group">
                <label for="sale_value">Valor da Venda:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="rs">R$</span>
                    </div>
                    <input type="text" class="form-control" id="sale_value" value="<?=$sale['sale_value']?>" name="sale_value" aria-describedby="rs">
                </div>
            </div>
        </div>    
        <div class="col-4">
            <div class="form-group">
                <label for="sale_date">Data da Venda:</label>
                <div class="input-group mb-3">
                    <input type="date" value="<?=$date?>" class="form-control" id="sale_date" name="sale_date">
                </div>
            </div>
        </div>                     
        <div class="col-sm-12">
        <hr>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </div>
</div>
</form>

<?php include '../../includes/footer.php';?>