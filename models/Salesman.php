<?php

require_once realpath(__DIR__) . "/../database/Database.php";
require_once realpath(__DIR__) . "/../models/BaseModel.php";

class Salesman extends BaseModel
{
    protected $table = 'salesman';
    protected $primaryKey = 'salesman_id';
    protected $validFields = ['salesman_email','salesman_name'];
    public $message;


    public function insert($request)
    {
        if(!isset($request['salesman_name']) || $request['salesman_name'] == ""){
            $this->message ='O campo "nome" é obrigatório';
            return false;
        }

        if(!isset($request['salesman_email']) || $request['salesman_email'] == "" || !filter_var($request['salesman_email'],FILTER_VALIDATE_EMAIL)){
            $this->message = 'O campo "e-mail" é inválido ou está vazio.';
            return false;
        }
       return parent::insert($request);

    }

    public function update($id,$request)
    {
        if(!isset($request['salesman_name']) || $request['salesman_name'] == ""){
            $this->message ='O campo "nome" é obrigatório';
            return false;
        }

        if(!isset($request['salesman_email']) || $request['salesman_email'] == "" || !filter_var($request['salesman_email'],FILTER_VALIDATE_EMAIL)){
            $this->message = 'O campo "e-mail" é inválido ou está vazio.';
            return false;
        }
       return parent::update($id,$request);
    }

    public function list($request)
    {
        $db = new Database();
        try{
            $sql = "SELECT * FROM ". $this->table;
            $where = []; 
            if(isset($request['campo1']) && $request['campo1'] != ""){ 
                array_push($where,"campo1 = '".$request['campo1']."'"); 
            }
            if(count($where) > 0) { 
                $where = join(" AND ",$where);
                $sql . " WHERE " . $where;
            }
            $res = $db->con->query($sql);
            return $res;
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }
    }
    public function listAll()
    {
        $db = new Database();
        try{
            $sql = "SELECT * FROM ". $this->table . " WHERE active = 'yes'";
            $res = $db->con->prepare($sql);
            $res->execute();

            return $res->fetchAll();
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }
    }
}