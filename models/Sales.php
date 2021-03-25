<?php 
    require_once realpath(__DIR__) . "../../database/Database.php";
    require_once realpath(__DIR__) . "../../models/BaseModel.php";

class Sales extends BaseModel
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $validFields = ['salesman_id','sale_value','sale_date'];
    public $message;
    
    public function insert($request)
    {
        if (!isset($request['sale_value']) || $request['sale_value'] == ""){
            $this->message = 'O campo "Valor da Venda" esta vazio ou inválido.';
            return false;
        }
        $request['sale_value'] = str_replace(".","",$request['sale_value']);
        $request['sale_value'] = str_replace(",",".",$request['sale_value']);        
        if(!is_double((double)$request['sale_value'])){
            $this->message = "Informe um valor válido";
            return false;
        }

        if(!isset($request['salesman_id']) || $request['salesman_id'] == "" || !is_numeric($request['salesman_id'])){
            $this->message = 'O campo "Vendedor" está vazio ou inválido.';
            return false;
        }
        
        if(!isset($request['sale_date']) || $request['sale_date'] == "" ){
            $this->message = 'O campo "Data da venda" está vazio ou inválido.';
            return false;
        }


        return parent::insert($request);
    }

    public function update($id,$request)
    {
        if (!isset($request['sale_value']) || $request['sale_value'] == ""){
            $this->message = 'O campo "Valor da Venda" esta vazio ou inválido.';
            return false;
        }
        $request['sale_value'] = str_replace(".","",$request['sale_value']);
        $request['sale_value'] = str_replace(",",".",$request['sale_value']);        
        if(!is_double((double)$request['sale_value'])){
            $this->message = "Informe um valor válido";
            return false;
        }

        if(!isset($request['salesman_id']) || $request['salesman_id'] == "" || !is_numeric($request['salesman_id'])){
            $this->message = 'O campo "Vendedor" está vazio ou inválido.';
            return false;
        }
        
        if(!isset($request['sale_date']) || $request['sale_date'] == "" ){
            $this->message = 'O campo "Data da venda" está vazio ou inválido.';
            return false;
        }


        return parent::update($id,$request);
    }

    public function salesList($id = null)
    {
        $db = new Database();
        try{
            $sql = "SELECT sale_id, sales.salesman_id, salesman_name, salesman_email, sale_value, sale_date FROM sales inner join salesman on sales.salesman_id = salesman.salesman_id";
            $sql .= " WHERE sales.active = 'yes'";
            if($id){
                $sql .= " AND salesman.salesman_id = ".$id;
            }
            $sql .= " ORDER BY sale_date DESC";           
            $res = $db->con->query($sql);
            return $res;
        }catch(Exception $e){
            $this->message = $e->getMessage();
            return false;
        }
    }    
}