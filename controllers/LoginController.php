<?php

require_once("../../models/Login.php");

class LoginController {
    const LIMIT = 3;
    public static $count = 0;

    public function login(){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $data = array(
            'name' => $name,
            'password' => $password
        );

        $login = User::getUserByNameAndPassword($data);
        return $login;
    }

    public static function signUp(){
        session_start();//ession_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $mail = $_POST['mail'];
            $age = $_POST['age'];
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['mail'] = $mail;
            $_SESSION['age'] = $age;

            $data = array(
                'name' => $name,
                'password' => $password,
                'mail' => $mail,
                'age' => $age,
            );

            if (!User::save($data)){
                header("Location: ../user/signUp.php?"."name=".$data['name']."&password=".$data['password']."&mail=".$data['mail']."&age=".$data['age']);
            }

            header("Location: ../user/login.php");
        }

        if(empty($_GET['name'])){
            $_GET['name']="";
        }
        if(empty($_GET['password'])){
            $_GET['password']="";
        }
        if(empty($_GET['age'])){
            $_GET['age']="";
        }
        if(empty($_GET['mail'])){
            $_GET['mail']="";
        }
        $title = $_GET['name'];
        $password = $_GET['password'];
        $age = $_GET['age'];
        $mail = $_GET['mail'];
        $data = array(
            'name' => $name,
            'password' => $password,
            'mail' => $mail,
            'age' => $age,
        );
        return $data;
    }
}

?>
