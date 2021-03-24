<?php

class Database{
    public $con;
    protected $host = "localhost";
    protected $database = "trey_db";
    protected $user = "root";
    protected $pass = "root";
    public function __construct()
    {
        try{
            $pdo = new \PDO('mysql:host='.$this->host.';dbname='.$this->database.'', $this->user, $this->pass);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->con = $pdo;

        }catch(\Exception $e){
            die($e->getMessage());
        }
    }
}
