<?php include '../../includes/header.php';
require_once '../../models/Salesman.php';

$salesman = new Salesman();
$list = $salesman->listAll();?>

<script>
$(document).ready(function(){
    $('#sale_value').mask('R$ 000.000.000.000.000,00', {reverse: true});
});
</script>

<form method="POST" action="../../controllers/SalesController.php" >
<div class="container">
<br><h2>Cadastrar Nova Venda</h2><br>
    <div class="row">
        <div class="col-4">
        <label for="salesman_name">Vendedor:</label> 
        <select class="form-control">
            <option value="" name="salesman_name">Selecione</option>
            <?php foreach($list as $l){ ?>
                <option value="<?= $l['salesman_id'] ?>"><?=$l['salesman_name'] ?></option><?php } ?>
        </select>
        </div>    
        <div class="col-4">
            <div class="form-group">
                <label for="sale_value">Valor da Venda:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="rs">R$</span>
                    </div>
                    <input type="text" class="form-control" id="sale_value" aria-describedby="rs">
                </div>
            </div>
        </div>    
        <div class="col-4">
            <div class="form-group">
                <label for="sale_date">Data da Venda:</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" id="sale_date">
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