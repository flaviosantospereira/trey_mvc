<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//die(realpath(__DIR__));
require_once realpath(__DIR__) . "/../../models/Sales.php";
require_once realpath(__DIR__) . "/../../database/Database.php";

$validActions = ['insert','delete','update'];

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){
            echo 'Método não é post.';
            exit(400);
        }
        $action = $_POST['action'];
        if(!in_array($action,$validActions)){
            echo 'Ação não é valida';
        }
        if($action == 'insert'){
            array_shift($_POST);
            $sales = new Sales;       
            $sales->insert($_POST);
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
        if($action == 'delete'){
            //deleta 
        }
        if($action == 'update'){
            //faz update n oresgistro
        }
?>