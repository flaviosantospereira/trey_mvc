<?php include '../../includes/header.php';
require_once '../../models/Salesman.php';

$salesman = new Salesman();
$list = $salesman->listAll();

if ($list){
?>
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
        <?php 
        if($list){
        
        foreach($list as $l){ 
          ?>
            <tr>
                <td><?= $l['salesman_id']?></td> 
                <td><?=$l['salesman_name']?></td>
                <td><?=$l['salesman_email']?></td>    
                <td><a class="btn btn-link text-primary btn-sm" href="../vendas/lista.php?salesman_id=<?=$l['salesman_id'] ?>"><span class="material-icons" >addchart</span></a></td>
                <td> <a class="btn btn-link text-success btn-sm" href="visualizar.php?salesman_id=<?=$l['salesman_id'] ?>"><span class="material-icons">update</span></a></td>
                <td> <a class="btn btn-sm btn-link text-danger" onclick="remove(<?=$l['salesman_id']?>)"><span class="material-icons">clear</span></a></td>                
            </tr>
        <?php }
        }
        ?>
    </tbody>
  </table>
</div>

<script>
  function remove(id)
  {
  if(confirm("Deseja deletar o item #" + id + "?")){
$.ajax({
 type: "POST",
 url: "/trey_mvc/home/vendedores/acoes.php",
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

<?php
  }else{
?>
    <div class='container-fluid'>
                <div class='alert alert-success text-center' role='alert'>
                Nenhum vendedor cadastrado com esses parâmetros   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
            </div>
<?php } ?>