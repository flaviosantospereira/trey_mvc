<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once realpath(__DIR__) . "/../models/Users.php";
require_once realpath(__DIR__) . "/../database/Database.php";
require_once realpath(__DIR__) . "/../session/Session.php";

$session = new Session;

$validActions = ['insert','delete','update','login', 'logout'];

    if ($_POST['action'] != 'login' && $_POST['action'] != 'logout' ){

        if ($_POST['action'] != 'login' && $_POST['user_name']==""){
            $message = "Informe um usuário";
            Session::setMessage($message,'danger');            
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit(400);
        }
        if ($_POST['user_email']==""){
            $message = "Digite um email válido";
            Session::setMessage($message,'danger');            
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit(400);
        }        
        if ($_POST['user_password']==""){
            $message = "Digite uma senha";
            Session::setMessage($message,'danger');
            header("location: ".$_SERVER['HTTP_REFERER']);
            exit(400);
        }

    }

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){
            echo 'Método inválido!';
            Session::setMessage($message,'danger');
            exit(400);
        }
        $action = $_POST['action'];
        if(!in_array($action,$validActions)){
            $message = 'Ação inválida!';
            Session::setMessage($message,'danger');            
            exit(400);
        }
        if($action == 'login'){
            array_shift($_POST);
            $user = new Users;       
            $user->tryLogin($_POST);
        }        
        if($action == 'logout'){
            array_shift($_POST);
            Session::logout();
            //$user = new Users;       
            //$user->tryLogin($_POST);
        }            
        if($action == 'insert'){
            array_shift($_POST);
            $user = new Users;       
            $user->createUser($_POST);           
            header("location: http://localhost/trey_mvc/home/login.php");
        }
        if($action == 'delete'){

        }
        if($action == 'update'){

        }
?>