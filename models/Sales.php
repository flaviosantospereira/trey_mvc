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
            $message = "Informe um valor válido";
            Session::setMessage($message,'danger');             
            return false;
        }
        $request['sale_value'] = str_replace(".","",$request['sale_value']);
        $request['sale_value'] = str_replace(",",".",$request['sale_value']);        
        if(!is_double((double)$request['sale_value'])){
            $message = "Informe um valor válido";
            Session::setMessage($message,'danger');              
            return false;
        }        
        return parent::insert($request);
    }
    public function salesList($id = null)
    {
        $db = new Database();
        try{
            $sql = "SELECT sale_id, sales.salesman_id, salesman_name, salesman_email, sale_value, sale_date FROM sales inner join salesmen on sales.salesman_id = salesmen.salesman_id";
            if($id){
                $sql .= " WHERE salesmen.salesman_id = ".$id;
            };
            $sql .= " ORDER BY sale_date DESC";           
            $res = $db->con->query($sql);
            return $res;
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }
    }    
}