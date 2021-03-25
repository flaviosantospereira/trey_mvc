<?php include '../../includes/header.php';
require_once realpath(__DIR__) . "/../../models/Sales.php";

$id = null;
if(isset($_GET['salesman_id']) && $_GET['salesman_id'] != "" && is_numeric($_GET['salesman_id'])){
  $id = $_GET['salesman_id'];
}
$sales = new Sales();
$list = $sales->salesList($id);
?>

<div class="container">
<br><h2>Vendas Cadastradas</h2><br>
<?php if($list){ ?>
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
                <td> <a class="btn btn-link text-success btn-sm" href="visualizar.php?sale_id=<?=$l['sale_id'] ?>"><span class="material-icons">update</span></a></td>
                <td> <a class="btn btn-sm btn-link text-danger" onclick="remove(<?=$l['sale_id']?>)"><span class="material-icons">clear</span></a></td>                
            </tr>
        <?php } ?>
    </tbody>
  </table>
  <?php 
  
  }
  ?>
</div>

<script>
  function remove(id)
  {
  if(confirm("Deseja deletar o item #" + id + "?")){
$.ajax({
 type: "POST",
 url: "/trey_mvc/home/vendas/acoes.php",//sua url de deletar acoes.php,
 data: { id: id, action: 'delete'},

 success:function(res){

   if(res.status == 'ok'){
     location.reload();
   }

}
})


}
  }
</script>