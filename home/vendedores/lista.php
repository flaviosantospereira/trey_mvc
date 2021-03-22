<?php include '../../includes/header.php';
require_once '../../models/Salesman.php';

$salesman = new Salesman();
$list = $salesman->listAll();?>

<div class="container">
<br><h2>Vendedores Cadastrados</h2><br>
  <table class="table">
    <thead>
      <tr>
        <th>Cadastro</th>
        <th>Nome</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($list as $l){ ?>
            <tr>
                <td><?= $l['salesman_id']?></td> 
                <td><?=$l['salesman_name']?></td>
                <td><?=$l['salesman_email']?></td>    
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>