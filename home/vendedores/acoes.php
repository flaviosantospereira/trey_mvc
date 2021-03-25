<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//die(realpath(__DIR__));
require_once realpath(__DIR__) . "/../../models/Salesman.php";
require_once realpath(__DIR__) . "/../../database/Database.php";
require_once realpath(__DIR__) . "/../../session/Session.php";

$session = new Session;

$validActions = ['insert','delete','update'];

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){

            //echo "metodo invalido";
            echo '<pre>';
            var_dump($_SERVER);
            echo '</pre>';
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
            array_shift($_POST);
            $sales = new Sales;       
            $sales->insert($_POST);
            $message = 'Venda cadastrada com sucesso!';
            Session::setMessage($message,'success');              
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
        if($action == 'delete'){
            Session::redirect('home/vendas/lista.php',['message'=>'Venda deletada!','type'=>'success']);
            //deleta 
        }
        if($action == 'update'){
            //faz update n oresgistro
        }
?>