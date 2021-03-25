<?php

require_once realpath(__DIR__) . "/../database/Database.php";
require_once realpath(__DIR__) . "/../models/BaseModel.php";

class Salesman extends BaseModel
{
    protected $table = 'salesmen';
    protected $primaryKey = 'salesman_id';
    protected $validFields = ['salesman_email'];
    public string $message;

    public function store($request)
    {
        $db = new Database();
        try{
            $bind = [];
            foreach($this->validFields as $value){
                $bind[":".$value];
            };
            $sql = "INSERT INTO " . $this->table . " (".join(",",$this->validFields) .") VALUES ( ". join(",",$bind) .")";
            $db->con->query($sql);
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }        
    }    
    public function list($request)
    {
        $db = new Database();
        try{
            $sql = "SELECT * FROM ". $this->table;
            $where = []; // where é um array vazio;
            if(isset($request['campo1']) && $request['campo1'] != ""){ // se o campo enviado no $_GET existir e NÃO for vazio ele inclui no array
                array_push($where,"campo1 = '".$request['campo1']."'"); // "empurra" o valor no array de where como se fosse no SQL
            }
            if(count($where) > 0) { //se o tamanho do where for maior que 0, ou seja existe algo nele, ele junta o array com "AND"
                $where = join(" AND ",$where);
                $sql . " WHERE " . $where; // assim o where fica SELECT * FROM table WHERE campo1 = 'valor' AND campo2 = 10
                                        // Se só tiver 1 valor no array por exemplo, ele não coloca o AND
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
            $sql = "SELECT * FROM ". $this->table;
            $res = $db->con->query($sql);
            return $res;
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }
    }
}