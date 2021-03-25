<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//die(realpath(_DIR_));
require_once realpath(__DIR__) . "/../../models/Sales.php";
require_once realpath(__DIR__) . "/../../database/Database.php";
require_once realpath(__DIR__) . "/../../session/Session.php";

$session = new Session;

$validActions = ['insert','delete','update'];

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){

            $message = 'Método inválido!';
            Session::setMessage($message,'danger');
            exit(400);
        }
        $action = $_POST['action'];
        if(!in_array($action,$validActions)){
            $message = 'Ação inválida!';
            Session::setMessage($message,'danger');   
            exit(400);
        }
        if($action == 'insert'){
            $sales = new Sales;       
            if(!$sales->insert($_POST)){
                Session::setMessage($sales->message,'danger');
                Session::redirect('home/vendas/nova.php');
                exit();
            }
            $message = 'Venda cadastrada com sucesso!';
            Session::setMessage($message,'success');   
            Session::redirect('home/vendas/lista.php');           
        }
        if($action == 'delete'){
            header('Content-Type: application/json');

            if(!isset($_POST['id']) || $_POST['id'] == ""){
                echo json_encode([
                    'status' => 'error'
                ]);
                exit();
            }
            $id = $_POST['id'];
            $sale = new Sales;       
            if($sale->delete($id)){
                Session::setMessage('Venda deletada com sucesso.','success');
                echo json_encode([
                    'status' => 'ok'
                ]);
                exit();
            }

        }
        if($action == 'update'){
            if(!isset($_GET['sale_id']) || $_GET['sale_id'] == ""){
                Session::setMessage('Venda não encontrado.','warning');
                Session::redirect('/home/vendas/lista.php');
                exit();
            }

                $sale = new Sales;       
                $id = $_GET['sale_id'];
                if(!$sale->read($id)){
                    Session::setMessage('Venda não encontrada.','warning');
                    Session::redirect('/home/vendas/lista.php');
                    exit();
            }
            if($sale->update($id,$_POST)){
                $message = 'Venda atualizado com sucesso!';
                Session::setMessage($message,'success');              
                Session::redirect("/home/vendas/lista.php");
                exit();
            }
            Session::setMessage($sale->message,'danger');              
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit();

        }
?>