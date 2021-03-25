<?php include '../includes/header.php';
require_once realpath(__DIR__) . "/../models/Sales.php";

$sales = new Sales();
$list = $sales->dailySales();
$total = 0;
$today = date('d-m-Y');
if ($list){
?>
<div class="container">
<br><h2>Vendas do Dia <?=$today?></h2><br>
  <table class="table">
    <thead>
      <tr>
        <th>Id. Venda</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data</th>        
        <th>Comissão</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($list as $l){ ?>
            <tr>
                <td><?=$l['sale_id']?></td>
                <td><?=$l['salesman_name']?></td>
                <td><?=$l['salesman_email']?></td>
                <?php $date = New DateTime($l['sale_date'])?> 
                <td><?=$date->format("d/m/Y")?></td>                                                   
                <td><?=number_format((($l['sale_value'] / 100) * 8.5),2, ',', ' ')?></td>
                <td><?=$l['sale_value']?></td>                                
                <?php $total += $l['sale_value']?> 
            </tr>
        <?php } ?>
        <hr>
        <h3>Total de Hoje | R$ <?=$total?></h3>        
    </tbody>
  </table>
</div>

<?php
  }else{
?>
    <div class='container-fluid'>
                <div class='alert alert-success text-center' role='alert'>
                Nenhuma venda cadastrada para o dia de hoje  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
            </div>
<?php } ?>