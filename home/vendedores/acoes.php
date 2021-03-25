<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//die(realpath(_DIR_));
require_once realpath(__DIR__) . "/../../models/Salesman.php";
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
            $salesman = new Salesman;       
            if($salesman->insert($_POST)){
                $message = 'Vendedor cadastrado com sucesso!';
                Session::setMessage($message,'success');              
                Session::redirect("/home/vendedores/lista.php");
                exit();
            }
            Session::setMessage($salesman->message,'danger');              
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit();

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
            $salesman = new Salesman;       
            if($salesman->delete($id)){
                Session::setMessage('Vendedor deletado com sucesso.','success');
                echo json_encode([
                    'status' => 'ok'
                ]);
                exit();
            }

        }
        if($action == 'update'){

            if(!isset($_GET['salesman_id']) || $_GET['salesman_id'] == ""){
                Session::setMessage('Vendedor não encontrado.','warning');
                Session::redirect('/home/vendedores/lista.php');
                exit();
            }

                $salesman = new Salesman;       
                $id = $_GET['salesman_id'];
                if(!$salesman->read($id)){
                    Session::setMessage('Vendedor não encontrado.','warning');
                    Session::redirect('/home/vendedores/lista.php');
                    exit();
            }
            if($salesman->update($id,$_POST)){
                $message = 'Vendedor atualizado com sucesso!';
                Session::setMessage($message,'success');              
                Session::redirect("/home/vendedores/lista.php");
                exit();
            }
            Session::setMessage($salesman->message,'danger');              
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }
?>