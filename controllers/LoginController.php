<?php

require_once("../../models/User.php");
require_once("../../validations/LoginValidation.php");
require_once("../../controllers/libs/Mail.php");

class LoginController {
    public function login(){
        session_start();
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST['name'];
            $password = $_POST['password'];

            $data = array(
                'name' => $name,
                'password' => $password
            );

            $validation = new LoginValidation;
            if(!$validation->loginCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/login.php?");
                return;
            }

            $user = User::getUserByNameAndPassword($data);
            $_SESSION['user'] = $user;

            if (!isset($_SESSION['user'])) {
                header('Location: ../user/login.php');
                return;
            }

            header('Location: ../todos/index.php');
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

    public static function enterEmail(){
        session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $mail = $_POST['mail'];
            $token = $_POST['token'];

            $data = array(
                'mail' => $mail,
                'token' => $token,
            );

            $validation = new LoginValidation;
            if(!$validation->enterEmailCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/enterEmail.php");
                return;
            }

            if (!User::saveEmail($data)){
                header("Location: ../user/enterEmail.php");
                return;
            }

            $mail = new Mail;
            $mail->to = $data['mail'];
            $mail->subject = 'TEST MAILS';
            $mail->message = <<< EOM
            Please click on the URL
            http://localhost/user/signUp.php?token={$data['token']}
            EOM;
            $mail->headers = 'From: k911672@gmail.com';
            $mail->send();

            header("Location: ../user/temporaryRegistration.php");
        }

        $mail = isset($_GET['mail'])? $_GET['mail']: "";
        $token = isset($_GET['token'])? $_GET['token']: "";
        $data = array(
            'mail' => $mail,
            'token' => $token,
        );
        return $data;
    }

    public static function signUp(){
        session_start();//session_start()の位置正しいか今度考える（sessionの値がないと出るため）

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $name = $_POST['name'];
            $password = $_POST['password'];
            $age = $_POST['age'];
            $token = $_POST['token'];

            $data = array(
                'name' => $name,
                'password' => $password,
                'age' => $age,
                'token' => $token,
            );

            $validation = new LoginValidation;
            if(!$validation->signUpCheck($data)){
                $_SESSION['errors'] = $validation->errors;
                header("Location: ../user/signUp.php?token=".$_POST["token"]);//GETパラメーターの記述必要
                return;
            }

            if (!User::saveCredential($data)){
                header("Location: ../user/signUp.php?token=".$_POST["token"]);
                return;
            }

            header("Location: ../user/completeRegistration.php");
        }

        $name = isset($_GET['name'])? $_GET['name']: "";
        $password = isset($_GET['password'])? $_GET['password']: "";
        $age = isset($_GET['age'])? $_GET['age']: "";
        $token = isset($_GET['token'])? $_GET['token']: "";
        $data = array(
            'name' => $name,
            'password' => $password,
            'age' => $age,
            'token' => $token,
        );
        return $data;
    }

    public function checkExistingUser(){
        $token = $_GET["token"];
        $user = User::getUserNameByToken($token);
        return $user;
    }
}

?>
