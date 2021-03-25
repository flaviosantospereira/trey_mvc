<?php include '../../includes/header.php';
require_once realpath(__DIR__) . "/../../models/Sales.php";

$sales = new Sales();
$list = $sales->salesList();
?>

<div class="container">
<br><h2>Vendas Cadastradas</h2><br>
  <table class="table">
    <thead>
      <tr>
        <th>Id. Venda</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Data</th>        
        <th>Comissão</th>
        <th>Valor</th>
        <th>Atualizar</th>
        <th>Deletar</th>
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
                <td><span class="material-icons">update</span></td>
                <form id="delete" method="POST" action="/trey_mvc/home/vendas/acoes.php">
                  <input type='hidden' name='action' value='delete'>                
                  <td><a href="#" onclick="delete('<?php $l['sale_id'] ?>')" ><span class="material-icons">delete</span></a></td>
                </form>                
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

<script>

function del(id){
  let del = confirm("Deseja deletar o item #" + id + "?")
  if(del){
    $.ajax({
    type: "POST",
    url: "/trey_mvc/home/vendas/acoes.php",//sua url de deletar acoes.php,
    data: { id: id, action: 'delete'},
    success:function(res){
      //vai ter que retornar json caso de sucesso ou falhe
    }
    })
  }
}
</script>