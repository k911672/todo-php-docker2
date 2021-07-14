<?php
require_once("BaseModel.php");




class Todo extends BaseModel {
    
    public static function findAll(){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlTodos = 'select * from todos where user_id=1 and delete_at is null';
            $stmtTodos = $pdo->prepare($sqlTodos);
            $stmtTodos->execute();
            $pdo = $stmtTodos->fetchAll();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function findById($todo_id){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlDetails = 'select * from todos where user_id=1 and id=:id';
            $stmtDetails = $pdo->prepare($sqlDetails);
            $stmtDetails->bindValue('id', $todo_id, PDO::PARAM_STR);
            $stmtDetails->execute();
            $pdo = $stmtDetails->fetch();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function save(){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlNewsTodos = 'insert into todos(user_id, title, detail) value(1, :title, :detail)';
            $stmtNewTodos = $pdo->prepare($sqlNewsTodos);
            $stmtNewTodos->bindValue(':title', $_GET['title'], PDO::PARAM_STR);
            $stmtNewTodos->bindValue(':detail', $_GET['detail'], PDO::PARAM_STR);
            $stmtNewTodos->execute();
            return;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }
}



?>