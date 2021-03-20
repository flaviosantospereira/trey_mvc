<?php

class Sales
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $validFields = ['sale_value','sale_date','created_at','created_by','updated_at','updated_by'];
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
            $message = 'Venda cadastrada com sucesso.';
        }catch(Exception $e){
            $message = 'Não foi possível cadastrar esta venda.';
        }        
    }
}