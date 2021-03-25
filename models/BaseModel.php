<?php

require_once realpath(__DIR__) . "../../session/Session.php";

class BaseModel{

    const ACTIVE = "active";

    public function read($id)
    {
        // Veriica se é numero
        if(!is_numeric($id)){
            return false;
        }
        $db = new Database(); 
        $preparedPk = ":".$this->primaryKey;
        $stmt = $db->con->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = " . $preparedPk); //Seleciona tudo
        $stmt->execute([
            $preparedPk => $id
        ]);
        if($stmt->rowCount() == 0){ // Se for 0 quer dizer que não existe o registro
            return false;
        } 
        //caso passe faz o fetch e traz tudo da tabela no return
        return $stmt->fetch();        
    }

    public function insert($request)
    {
        $request = $this->cleanArray($request);
        $cleanArr = $this->validFields; //Passa os valores do valid array para um array comum
        array_push($cleanArr,'created_by','created_at'); //Adiciona os campos default de criação ao array antes de prepara-lo
        $preparedArr = $this->prepare($cleanArr); // Chamda o método para "preparar" os campos da tabela, ou seja apenas coloca um : antes do campo para transforma-lo em variavel do PDO

        $request['created_at'] = date('Y-m-d H:i:s'); //Seta manualmente o horario em que foi criado no banco
        $request['created_by'] = Session::get('user_id'); //Esse vlaor poder ser comentado mas o ideal é que pegasse da sessão quem criou o item no banco

        $sql = "INSERT INTO ".$this->table." (".join(',',$cleanArr).") VALUES (".join(',',$preparedArr).")"; //Junta as colunas válidas da model e no insert chama as colunas "preparadas"

        $db = new Database();
        $stmt = $db->con->prepare($sql); //Usa o método prepare do PDO
        $stmt->execute($request); // Executa com a request que seria a variavel $_POST
        if($stmt->rowCount() > 0){
            return true;
        }        
        return false;
    }
    public function update($id,$request)
    {
        // Primeiro verifica se o registro existe e se é um numero;
        if(!is_numeric($id)){
            return false;
        }
        $db = new Database(); 
        $preparedPk = ":".$this->primaryKey;
        $stmt = $db->con->prepare("SELECT " . $this->primaryKey . " FROM " . $this->table . " WHERE " . $this->primaryKey . " = " . $preparedPk);
        $stmt->execute([
            $preparedPk => $id
        ]);
        if($stmt->rowCount() == 0){
            return false;
        } 
        
        $request = $this->cleanArray($request); //Limpa os campos pegando só o que for da classe
        $cleanArr = $this->validFields; //pega os campos validos
        array_push($cleanArr,'updated_by','updated_at'); //adiciona os campos padroes de update
        $preparedArr = $this->prepare($cleanArr); //prepara o aray com os : antes do campo
        $values = $this->prepareForUpdate($cleanArr,$preparedArr); //Prepara para o update colocand oos campos da forma campo = :campo
        $request['updated_by'] = 1; //chama o usuario da sessão aqui; 
        $request['updated_at'] = date('Y-m-d H:i:s'); // Adiciona os campos padroes do update na request
        $request[$this->primaryKey] = $id; // Adiciona o PK para ser alterado
        $sql = "UPDATE " . $this->table . " SET " . join(" , ",$values) . " WHERE " . $this->primaryKey = $preparedPk;
        $stmt = $db->con->prepare($sql);
        $stmt->execute($request);
        if($stmt->rowCount() == 1){
            return true;
        }

        return false;
        
    }
    private function prepareForUpdate($keys,$values)
    {
        $values = array_combine($keys,$values);
        $res = [];
        foreach($values as $key => $value){
            $preparedValue = $key . " = " . $value;
            array_push($res,$preparedValue);
        }
        
        return $res;

    }
    public function delete($id)
    {
        //verifica se é numeric e se existe
    // Primeiro verifica se o registro existe e se é um numero;
    $preparedPk = ":".$this->primaryKey;
    if(!is_numeric($id)){
        return false;
    }
    $db = new Database(); 
    $preparedPk = ":".$this->primaryKey;
    $stmt = $db->con->prepare("SELECT " . $this->primaryKey . " FROM " . $this->table . " WHERE " . $this->primaryKey . " = " . $preparedPk);
    $stmt->execute([
        $preparedPk => $id
    ]);
    if($stmt->rowCount() == 0){
        return false;
    } 

    $sql = "UPDATE " . $this->table . " SET " . self::ACTIVE . " = 'no' WHERE " . $this->primarKey . " = " . $preparedPk; 
    $stmt = $db->con->prepare($sql);
    $stmt->execute([
        $preparedPk => $id
    ]);
    if($stmt->rowCount() == 1){
        return true;
    }

    return false;
                
    }        
    private function prepare($cleanArr)
    {
        $preparedArr = [];
        foreach($cleanArr as $field){
            array_push($preparedArr,":".$field);
        }        
        return $preparedArr;
    }
    private function cleanArray($request)
    {
        $res = [];
        foreach($request as $key => $value){
            if(!in_array($key,$this->validFields)){
                continue;
            }
            $res[$key] = $value;
        }
        return $res;
    }    
}