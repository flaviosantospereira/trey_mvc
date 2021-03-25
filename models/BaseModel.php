<?php

require_once realpath(__DIR__) . "../../session/Session.php";

class BaseModel{

    const ACTIVE = "active";

    public function read($id)
    {
        if(!is_numeric($id)){
            return false;
        }
        $db = new Database(); 
        $preparedPk = ":".$this->primaryKey;
        $stmt = $db->con->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = " . $preparedPk); 
        $stmt->execute([
            $preparedPk => $id
        ]);
        if($stmt->rowCount() == 0){ 
            return false;
        } 
        return $stmt->fetch();        
    }

    public function insert($request)
    {

        $request = $this->cleanArray($request);
        $cleanArr = $this->validFields; 
        array_push($cleanArr,'created_by','created_at','active'); 
        $preparedArr = $this->prepare($cleanArr); 

        $request['created_at'] = date('Y-m-d H:i:s'); 
        $request['created_by'] = Session::get('user_id'); 
        $request['active'] = 'yes';
        $sql = "INSERT INTO ".$this->table." (".join(',',$cleanArr).") VALUES (".join(',',$preparedArr).")"; 
        $db = new Database();
        $stmt = $db->con->prepare($sql); 
        $stmt->execute($request); 
        if($stmt->rowCount() > 0){
            return true;
        }        
        return false;
    }
    public function update($id,$request)
    {
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
        
        $request = $this->cleanArray($request); 
        $cleanArr = $this->validFields; 
        array_push($cleanArr,'updated_by','updated_at'); 
        $preparedArr = $this->prepare($cleanArr); 
        $values = $this->prepareForUpdate($cleanArr,$preparedArr); 
        $request['updated_by'] = 1; 
        $request['updated_at'] = date('Y-m-d H:i:s'); 
        $request[$this->primaryKey] = $id; 
        $sql = "UPDATE " . $this->table . " SET " . join(" , ",$values) . " WHERE " . $this->primaryKey . ' = ' . $preparedPk;
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

    $sql = "UPDATE " . $this->table . " SET " . self::ACTIVE . " = 'no' WHERE " . $this->primaryKey . " = " . $preparedPk; 
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