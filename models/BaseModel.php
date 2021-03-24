<?php

class BaseModel{
    public function insert($request)
    {
        $cleanArr = $this->validFields; //Passa os valores do valid array para um array comum
        array_push($cleanArr,'created_by','created_at'); //Adiciona os campos default de criação ao array antes de prepara-lo
        $preparedArr = $this->prepare($cleanArr); // Chamda o método para "preparar" os campos da tabela, ou seja apenas coloca um : antes do campo para transforma-lo em variavel do PDO

        $request['created_at'] = date('Y-m-d H:i:s'); //Seta manualmente o horario em que foi criado no banco
        $request['created_by'] = 1; //Esse vlaor poder ser comentado mas o ideal é que pegasse da sessão quem criou o item no banco

        $sql = "INSERT INTO ".$this->table." (".join(',',$cleanArr).") VALUES (".join(',',$preparedArr).")"; //Junta as colunas válidas da model e no insert chama as colunas "preparadas"

        $db = new Database();
        $stmt = $db->con->prepare($sql); //Usa o método prepare do PDO
        $stmt->execute($request); // Executa com a request que seria a variavel $_POST
        if($stmt->rowCount() > 0){
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

}