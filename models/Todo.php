<?php
require_once("BaseModel.php");

class User extends BaseModel {

    public static function login($data){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlUsers = 'select * from users where name=:name and password=:password';
            $stmtUsers = $pdo->prepare($sqlUsers);
            $stmtUsers->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmtUsers->bindValue(':password', $data['password'], PDO::PARAM_STR);
            $stmtUsers->execute();
            $pdo = $stmtUsers->fetch();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function signUp($data){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlNewUsers = 'insert into users(name, password, mail, age) value(:name, :password, :mail, :age)';
            $stmtNewUsers = $pdo->prepare($sqlNewUsers);
            $stmtNewUsers->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':password', $data['password'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':mail', $data['mail'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':age', $data['age'], PDO::PARAM_STR);
            $result = $stmtNewUsers->execute();
            return $result;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return $result;
        }
    }

}

class Todo extends BaseModel {
    const STATUS_INCOMPLETE = '1';
    const STATUS_COMPLETE = '2';
    const DELETE_INCOMPLETE = 'NULL';
    const DELETE_COMPLETE = '1';

    public static function findAll(){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlUsers = 'select * from todos where user_id=1 and delete_at is null';
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

    public static function findByQuery($query){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $stmtQueries = $pdo->prepare($query);
            foreach ($_GET as $key => $data) {
                if(!empty($data) && !empty($key) && $key !== 'row'){
                    $stmtQueries->bindValue(':'.$key, $data, PDO::PARAM_STR);
                }
            }

            $stmtQueries->execute();
            $pdo = $stmtQueries->fetchAll();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function save($data){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlNewsTodos = 'insert into todos(user_id, title, detail, status) value(1, :title, :detail, 1)';
            $stmtNewTodos = $pdo->prepare($sqlNewsTodos);
            $stmtNewTodos->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $stmtNewTodos->bindValue(':detail', $data['detail'], PDO::PARAM_STR);
            $result = $stmtNewTodos->execute();
            return $result;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return $result;
        }
    }

    public static function update($data){
        try {
            $pdo = BaseModel::dbConnect();
            $pdo->beginTransaction();
            echo "接続成功\n";

            $sqlEditTodos = 'update todos set title=:title, detail=:detail where id=:id';
            $stmtEditTodos = $pdo->prepare($sqlEditTodos);
            $stmtEditTodos->bindValue(':title', $data['title'], PDO::PARAM_STR);
            $stmtEditTodos->bindValue(':detail', $data['detail'], PDO::PARAM_STR);
            $stmtEditTodos->bindValue(':id',$data['todo_id'] , PDO::PARAM_STR);
            $result = $stmtEditTodos->execute();
            if( $result ) {
                $pdo->commit();
            }
            return $result;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            $pdo->rollBack();
            return $result;
        }
    }

    public static function updateStatus($data){
        try {
            $pdo = BaseModel::dbConnect();
            $pdo->beginTransaction();
            $sqlUpdateStatus = 'update todos set status=:status where id=:id';
            $stmtUpdateStatus = $pdo->prepare($sqlUpdateStatus);
            $stmtUpdateStatus->bindValue(':id', $data['todo_id'], PDO::PARAM_STR);
            $stmtUpdateStatus->bindValue(':status', $data["status"], PDO::PARAM_STR);
            $result = $stmtUpdateStatus->execute();
            if( $result ) {
                $pdo->commit();
            }
            return $result;
        } catch(PDOException $e){
            $pdo->rollBack();
            return $result;
        }
    }

    public static function delete($data){
        try {
            $date = date("Y-m-d H:i:s");
            $pdo = BaseModel::dbConnect();
            $pdo->beginTransaction();
            $sqlDeleteTodo = 'update todos set delete_at=:delete_at where id=:id';
            $stmtDeleteTodo = $pdo->prepare($sqlDeleteTodo);
            $stmtDeleteTodo->bindValue(':id', $data['todo_id'], PDO::PARAM_STR);
            $stmtDeleteTodo->bindValue(':delete_at', $date, PDO::PARAM_STR);
            $result = $stmtDeleteTodo->execute();
            if( $result ) {
                $pdo->commit();
            }
            return $result;
        } catch(PDOException $e){
            $pdo->rollBack();
            return $result;
        }
    }
}



?>
