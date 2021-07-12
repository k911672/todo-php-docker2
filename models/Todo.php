<?php
require_once("BaseModel.php");




class Todo extends BaseModel {
    
    public static function findAll(){
        try {
            $todos = BaseModel::getPdoInstance();
            echo "接続成功\n";

            $sqlTodos = 'select * from todos  where user_id=1 and delete_at is null';
            $stmtTodos = $todos->prepare($sqlTodos);
            $stmtTodos->execute();
            $todos = $stmtTodos->fetchAll();

            return $todos;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function findById($todo_id){
        try {
            $details = BaseModel::getPdoInstance();
            echo "接続成功\n";

            $sqlDetails = 'select * from todos where user_id=1 and id=:id';
            $stmtDetails = $details->prepare($sqlDetails);
            $stmtDetails->bindValue('id', $todo_id, PDO::PARAM_STR);
            $stmtDetails->execute();
            $details = $stmtDetails->fetch();

            return $details;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function insertValue(){
        try {
            $newTodos = BaseModel::getPdoInstance();
            echo "接続成功\n";

            $sqlNewsTodos = 'insert into todos(user_id, title, detail) value(1, :title, :detail)';
            $stmtNewTodos = $newTodos->prepare($sqlNewsTodos);
            $stmtNewTodos->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
            $stmtNewTodos->bindValue(':detail', $_POST['detail'], PDO::PARAM_STR);
            $stmtNewTodos->execute();
            return;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }
}



?>