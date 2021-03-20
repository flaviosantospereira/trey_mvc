<?php

class Sales
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $validFields = ['sale_value','sale_date','created_at','created_by','updated_at','updated_by'];
    
    public function store($request)
    {
        $db = new Database();
        $bind = [];
        foreach($this->validFields as $value){
            $bind[":".$value];
        };
        $sql = "INSERT INTO " . $this->table . " (".join(",",$this->validFields) .") VALUES ( ". join(",",$bind) .")";
        $db->con->query($sql);
    }
}