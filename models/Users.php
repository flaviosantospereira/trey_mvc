<?php
    require_once realpath(__DIR__) . "../../database/Database.php";
    require_once realpath(__DIR__) . "../../models/BaseModel.php";
    require_once realpath(__DIR__) . "../../session/Session.php";

class Users extends BaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $validFields = ['user_name','user_email','user_password','user_role'];
    public $message;
      
        public function createUser(array $request)
        {
            if (!isset($request['user_role'])){
                $request['user_role'] = 0;
            }else{
                $request['user_role'] = 1;
            }             
            $db = new Database();

            $stmt = $db->con->prepare("SELECT user_email FROM " . $this->table . " WHERE user_email = :user_email");
            $stmt->execute([
                ':user_email' => $request['user_email']
            ]);
            if($stmt->rowCount() > 0){ 
                $this->message = sprintf("O e-mail %s já esta em uso",$request['user_email']);
                Session::setMessage($this->message,'danger');
                return false;
            }

            $sql = "INSERT " . $this->table . " (user_name, user_email,user_password, user_role, created_at) VALUES (:user_name,:user_email,:user_password, :user_role, :created_at)";
            $stmt = $db->con->prepare($sql);
            $stmt->execute([
                ':user_name' => $request['user_name'],
                ':user_email' => $request['user_email'],
                ':user_password' => \password_hash($request['user_password'],PASSWORD_BCRYPT),
                ':user_role' => $request['user_role'],
                ':created_at' => date('Y-m-d H:i:s')
            ]);
            if($stmt->rowCount() == 1){
                Session::setMessage('Usuário cadastrado com sucesso','success');
                return true;
            }
        }
    public function tryLogin(array $request)
    {
        $db = new Database();
        $sql = "SELECT * FROM " . $this->table . " WHERE user_email = :user_email";
        $stmt = $db->con->prepare($sql);
        $stmt->execute([
            ':user_email' => $request['user_email']
        ]);
        if($stmt->rowCount() == 1){
            $user = $stmt->fetch();
            if(password_verify($request['user_password'],$user['user_password'])){
                Session::start($user);
                Session::redirect('home/home.php',['message' => 'Bem vindo(a) '.Session::get('user_name').'!', 'type'=>'success']);
                return true;
            }
        }
        return false;
    }
}