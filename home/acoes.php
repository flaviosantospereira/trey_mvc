<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

//die(realpath(__DIR__));
require_once realpath(__DIR__) . "/../models/Users.php";
require_once realpath(__DIR__) . "/../database/Database.php";

$validActions = ['insert','delete','update','login'];

        $method = $_SERVER['REQUEST_METHOD'];
        if($method != "POST"){
            echo 'Método não é post.';
            exit(400);
        }
        $action = $_POST['action'];
        if(!in_array($action,$validActions)){
            echo 'Ação não é valida';
        }
        if($action == 'login'){
            array_shift($_POST);
            $user = new Users;       
            $user->login($_POST);
        }        
        if($action == 'insert'){
            array_shift($_POST);
            $user = new Users;       
            $user->createUser($_POST);
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
        if($action == 'delete'){

        }
        if($action == 'update'){

        }
?>