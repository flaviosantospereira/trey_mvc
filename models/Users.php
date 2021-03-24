<?php
    require_once realpath(__DIR__) . "../../database/Database.php";
    require_once realpath(__DIR__) . "../../models/BaseModel.php";

class Users extends BaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $validFields = ['user_name','user_email','user_password','user_role'];
    public string $message;

    public function createUser($request)
    {
        if (!isset($request['user_name'])){
            return false;
        }
        if (!isset($request['user_email'])){
            return false;
        }        
        if (!isset($request['user_password'])){
            return false;
        }
        if (!isset($request['user_role'])){
            $request['user_role'] = 0;
        }else{
            $request['user_role'] = 1;
        }        
        $request['user_password'] = password_hash($request['user_password'],PASSWORD_BCRYPT);
        $cleanArr = $this->validFields; 
        array_push($cleanArr,'created_at'); 
        $request['created_at'] = date('Y-m-d H:i:s'); 
        $sql = "INSERT INTO ".$this->table." (".join(',',$cleanArr).") VALUES (:user_name,:user_email,:user_password,:user_role,:created_at)";  
        $db = new Database();
        $stmt = $db->con->prepare($sql);
        $stmt->execute($request);
        if($stmt->rowCount() > 0){
            return true;
        }        
        return false; 
    }
    public function login($request)
    {
        if (!isset($request['user_email'])){
            return false;
        }        
        if (!isset($request['user_password'])){
            return false;
        }
        try{
            $sql = "SELECT * FROM ". $this->table . " WHERE user_email = :user_email";
            $db = new Database();
            $query =  $db->con->prepare($sql);
            $query->execute([':user_email' => $request['user_email']]);
                if($query->rowCount() == 1){ // ou seja se existe alguem com esse email
                $user = $query->fetch(); //Faz o "fetch" da resposta e traz todos os dados
                    if(password_verify($request['user_password'],$user['user_password'])){ //verifica se o password existe
                        //inicia a sessão e loga o usuario, por exemplo:
                    $session = new Session();
                    $session->initSession($user); 
                    }
                }
            }catch(Exception $e){
                $this->message = $e->getMessage();
                return false;
            }        
    }
}