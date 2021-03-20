<?php

class Database{
    public $con;
    protected $host = "localhost";
    protected $database = "seu banco";
    protected $user = "root";
    protected $pass = "";
    public function __construct()
    {
        try{
            $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', '%s', '%s'),$this->host,$this->database,$this->user,$this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->con = $pdo;

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

}