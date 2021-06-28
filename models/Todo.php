<?php
require_once("BaseModel.php");


class Todo extends BaseModel {
    
    public function findAll(){
        try {
            $todos = $this->getPdoInstance();
            echo "接続成功\n";

            $sqlTodos = 'select * from todos  where user_id=1 and delete_at is null';
            $stmtTodos = $todos->prepare($sqlTodos);
            $stmtTodos->execute();
            $todos = $stmtTodos->fetchAll();

            return $todos;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            exit();
        }
    }
}



?>