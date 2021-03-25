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
        <th>Vendas</th>
        <th>Atualizar</th>
        <th>Deletar</th>        
      </tr>
    </thead>
    <tbody>
        <?php foreach($list as $l){ ?>
            <tr>
                <td><?= $l['salesman_id']?></td> 
                <td><?=$l['salesman_name']?></td>
                <td><?=$l['salesman_email']?></td>    
                <td><span class="material-icons">addchart</span></td>
                <td><span class="material-icons">update</span></td>
                <td><span class="material-icons">clear</span></td>                
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>