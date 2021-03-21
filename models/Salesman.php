<?php

class Salesman
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
            $message = 'Vendedor cadastrado com sucesso.';
        }catch(Exception $e){
            $message = 'Não foi possível cadastrar este vendedor.';
        }        
    }    
    public function list($request)
    {
        $db = new Database();
        try{
            if(!$request){
                $sql = "SELECT * FROM ". $this->table;
            }else{
                $sql = "SELECT * FROM ". $this->table ." WHERE ". $this->primaryKey ." = ".$request;            
            };
            $db->con->query($sql);
        }catch(Exception $e){
            $message = 'Não foi possível listar os vendedores.';
        }
    }
}