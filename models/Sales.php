<?php 
    require_once realpath(__DIR__) . "../../database/Database.php";
    require_once realpath(__DIR__) . "../../models/BaseModel.php";

class Sales extends BaseModel
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $validFields = ['salesman_id','sale_value','sale_date'];
    public string $message;
    
    public function insert($request)
    {
        if (!isset($request['sale_value'])){
            return false;
        }
        $request['sale_value'] = str_replace(".","",$request['sale_value']);
        $request['sale_value'] = str_replace(",",".",$request['sale_value']);        
        if(!is_double((double)$request['sale_value'])){
            return false;
        }        
        return parent::insert($request);
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