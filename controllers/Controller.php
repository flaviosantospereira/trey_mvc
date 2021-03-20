<?php

class Controller
{
    public function view($view, ...$vars){
        require_once ('../views/includes/header.php');
        require_once ("../views/" .$view .".php");
        require_once ('../views/includes/footer.php');
    }
}