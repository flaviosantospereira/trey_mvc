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

/*

CREATE TABLE sales (
sale_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
salesman_id INT NULL,
sale_value DECIMAL(10,2) NULL,
sale_date DATETIME  NULL,
created_at DATETIME NULL,
updated_at DATETIME NULL,
created_by VARCHAR(30) NULL,
updated_by VARCHAR(30) NULL,
FOREIGN KEY (salesman_id) REFERENCES salesman(salesman_id)
)

CREATE TABLE salesman (
salesman_id INT AUTO_INCREMENT PRIMARY KEY,
salesman_name VARCHAR(30) NULL,
salesman_email VARCHAR(60) NULL);

*/