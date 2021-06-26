<?php

class Todo {
    const DB_HOST = 'mysql:dbname=todo; host=mysql';
    const DB_USER = 'naoki';
    const DB_PASSWORD = '11922960Kim@';
    
    public function findAll(){
        try {
            $todos = new PDO(Todo::DB_HOST, Todo::DB_USER, Todo::DB_PASSWORD,[
                PDO :: ATTR_DEFAULT_FETCH_MODE => PDO :: FETCH_ASSOC,//データベースから返って来る値を連想配列で返す。
                PDO :: ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//例外を表示する。
                PDO :: ATTR_EMULATE_PREPARES => false//SQLインジェクション対策
            ]);
            echo "接続成功\n";

            $sqlTodos = 'select * from todos  where user_id=1';
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