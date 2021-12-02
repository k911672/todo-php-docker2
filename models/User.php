<?php
require_once("BaseModel.php");

class User extends BaseModel {

    public static function getUserByNameAndPassword($data){
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

    public static function getUserNameByToken($token){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlUsers = 'select * from users where token=:token';
            $stmtUsers = $pdo->prepare($sqlUsers);
            $stmtUsers->bindValue(':token', $token, PDO::PARAM_STR);
            $stmtUsers->execute();
            $pdo = $stmtUsers->fetch();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function getUserByEnterMail($mail){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlUsers = 'select * from users where mail=:mail';
            $stmtUsers = $pdo->prepare($sqlUsers);
            $stmtUsers->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmtUsers->execute();
            $pdo = $stmtUsers->fetch();

            return $pdo;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return;
        }
    }

    public static function saveEmail($data){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlNewUsers = 'insert into users(mail, token) value(:mail, :token)';
            $stmtNewUsers = $pdo->prepare($sqlNewUsers);
            $stmtNewUsers->bindValue(':mail', $data['mail'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':token', $data['token'], PDO::PARAM_STR);
            $result = $stmtNewUsers->execute();
            return $result;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return $result;
        }
    }

    public static function saveCredential($data){
        try {
            $pdo = BaseModel::dbConnect();
            echo "接続成功\n";

            $sqlNewUsers = 'update users set name=:name, password=:password, age=:age where token=:token';
            $stmtNewUsers = $pdo->prepare($sqlNewUsers);
            $stmtNewUsers->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':password', $data['password'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':age', $data['age'], PDO::PARAM_STR);
            $stmtNewUsers->bindValue(':token', $data['token'], PDO::PARAM_STR);
            $result = $stmtNewUsers->execute();
            return $result;
        } catch(PDOException $e){
            echo "接続失敗\n". $e->getMessage()."\n";
            return $result;
        }
    }
}



?>
