<?php include '../../includes/header.php';?>

<div class="container">
<h2>Cadastrar Nova Venda</h2>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="usr">Vendedor:</label>    
                <input type="text" class="form-control" id="usr" name="salesman_id">
            </div>
        </div>    
        <div class="col-4">
            <div class="form-group">
                <label for="usr">Valor da Venda:</label>    
                <input type="text" class="form-control" id="usr" name="sale_value">
            </div>
        </div>        
        <div class="col-2">
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </div>
    </div>
</div>


<?php include '../../includes/footer.php';?>