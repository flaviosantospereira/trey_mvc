<?php include '../../includes/header.php';
require_once realpath(__DIR__) . "/../../models/Sales.php";

$sales = new Sales();
$list = $sales->listAll();?>



<div class="container">
<br><h2>Vendas Cadastradas</h2><br>
  <table class="table">
    <thead>
      <tr>
        <th>Id.</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data</th>        
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($list as $l){ ?>
            <tr>
                <td><?=$l['salesman_id']?></td>
                <td> nome </td>
                <td> email</td>
                <td><?=$l['sale_date']?></td>                    
                <td><?=$l['sale_value']?></td>                    
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>