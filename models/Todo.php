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

    public function findById(){
        try {
            $details = $this->getPdoInstance();
            echo "接続成功\n";

            $sqlDetails = 'select * from todos  where user_id=1 and title="本日の仕事"';
            $stmtDetails = $details->prepare($sqlDetails);
            $stmtDetails->execute();
            $details = $stmtDetails->fetchAll();

            return $details;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            exit();
        }
    }
}



?>