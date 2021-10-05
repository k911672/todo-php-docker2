<?php

require_once("../../models/Login.php");
require_once("../../validations/LoginValidation.php");

class LoginController {
    public function login(){
        session_start();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;

            $data = array(
                'name' => $name,
                'password' => $password
            );

            $user = User::getUserByNameAndPassword($data);

            $validation = new LoginValidation;
            if(!$validation->loginCheck($data, $user)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/login.php?");
                return;
            }

            if($user['name'] === $_POST['name'] && $user['password'] === $_POST['password']){
                header('Location: ../todos/index.php');
            }
        }

        if(empty($_GET['name'])){
            $_GET['name']="";
        }
        if(empty($_GET['password'])){
            $_GET['password']="";
        }
        $name = $_GET['name'];
        $password = $_GET['password'];
        $data = array(
            'name' => $name,
            'password' => $password,
        );
        return $data;

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

            $validation = new LoginValidation;
            if(!$validation->signUpCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/signUp.php");
                return;
            }

            if (!User::save($data)){
                header("Location: ../user/signUp.php");
                return;
            }

            header("Location: ../user/login.php");
        }

        $name = isset($_GET['name'])? $_GET['name']: "";
        $password = isset($_GET['password'])? $_GET['password']: "";
        $age = isset($_GET['age'])? $_GET['age']: "";
        $mail = isset($_GET['mail'])? $_GET['mail']: "";
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
